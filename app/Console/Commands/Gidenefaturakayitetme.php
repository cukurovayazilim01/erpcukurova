<?php

namespace App\Console\Commands;

use App\Http\Controllers\GidenefaturalarController;
use App\Models\Commandslog;
use App\Models\Gidenefaturadata;
use App\Models\Gidenefaturalar;
use Illuminate\Console\Command;

class Gidenefaturakayitetme extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gidenefatura:kayit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gelen e-faturalari ceker ve vt kayit eder';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        try {
            $controller = new GidenefaturalarController();
            $response = $controller->getEinvoicegiden(request());

            if (!$response || !is_array($response)) {
                $this->error('Giden faturalar alınamadı.');
                Commandslog::create([
                    'command_name' => 'gidenefatura:kayit',
                    'status' => 'error',
                    'message' => 'Giden faturalar alınamadı',
                    'context' => json_encode([]),
                    'logged_at' => now(),
                ]);
                return;
            }

            foreach ($response as $invoice) {
                try {
                    $note = isset($invoice['note']) && strlen($invoice['note']) <= 255 ? $invoice['note'] : null;
                    $notesJson = json_encode($invoice['notes'] ?? []);
                    $notes = strlen($notesJson) <= 65535 ? $notesJson : null;

                    $gidenFatura = Gidenefaturalar::updateOrCreate(
                        ['uuid' => $invoice['uuid']],
                        [
                            'fatura_no' => $invoice['id'] ?? null,
                            'profile_id' => $invoice['profile_id'] ?? null,
                            'type_code' => $invoice['type_code'] ?? null,
                            'issue_date' => $invoice['issue_date'] ?? null,
                            'currency' => $invoice['currency'] ?? 'TRY',
                            'note' => $note,
                            'notes' => $notes,

                            'sender_name' => $invoice['sender']['name'] ?? null,
                            'sender_vkn_tckn' => $invoice['sender']['vkn_tckn'] ?? null,
                            'sender_city' => $invoice['sender']['city'] ?? null,
                            'sender_city_subdivision' => $invoice['sender']['city_subdivision'] ?? null,
                            'sender_tax_office' => $invoice['sender']['tax_office'] ?? null,
                            'sender_email' => $invoice['sender']['email'] ?? null,

                            'receiver_name' => $invoice['receiver']['name'] ?? null,
                            'receiver_vkn_tckn' => $invoice['receiver']['vkn_tckn'] ?? null,
                            'receiver_city' => $invoice['receiver']['city'] ?? null,
                            'receiver_city_subdivision' => $invoice['receiver']['city_subdivision'] ?? null,
                            'receiver_tax_office' => $invoice['receiver']['tax_office'] ?? null,
                            'receiver_email' => $invoice['receiver']['email'] ?? null,

                            'line_extension' => $invoice['line_extension'] ?? 0,
                            'line_extension_currency' => $invoice['line_extension_currency'] ?? 'TRY',
                            'tax_exclusive' => $invoice['tax_exclusive'] ?? 0,
                            'tax_exclusive_currency' => $invoice['tax_exclusive_currency'] ?? 'TRY',
                            'tax_inclusive' => $invoice['tax_inclusive'] ?? 0,
                            'tax_inclusive_currency' => $invoice['tax_inclusive_currency'] ?? 'TRY',
                            'allowance' => $invoice['allowance'] ?? 0,
                            'allowance_currency' => $invoice['allowance_currency'] ?? 'TRY',
                            'payable' => $invoice['payable'] ?? 0,
                            'payable_currency' => $invoice['payable_currency'] ?? 'TRY',

                            'tax_amount' => $invoice['tax']['amount'] ?? 0,
                            'tax_amount_currency' => $invoice['tax']['amount_currency'] ?? 'TRY',
                            'tax_subtotals' => json_encode($invoice['tax']['subtotals'] ?? []),
                            'tax_totals' => json_encode($invoice['tax_totals'] ?? []),
                            'json_data' => json_encode($invoice),
                        ]
                    );

                    foreach ($invoice['lines'] as $item) {
                        try {
                            Gidenefaturadata::updateOrCreate(
                                [
                                    'gidenefatura_id' => $gidenFatura->id,
                                    'name' => $item['name'],
                                ],
                                [
                                    'quantity' => $item['quantity'] ?? 1,
                                    'quantity_unit' => $item['quantity_unit'] ?? 'NIU',
                                    'price' => $item['price'] ?? 0,
                                    'price_currency' => $item['price_currency'] ?? 'TRY',
                                    'extension_amount' => $item['extension_amount'] ?? 0,
                                    'extension_amount_currency' => $item['extension_amount_currency'] ?? 'TRY',
                                    'sellers_id' => $item['sellers_id'] ?? null,
                                    'buyers_id' => $item['buyers_id'] ?? null,

                                    'tax_amount' => $item['tax']['amount'] ?? 0,
                                    'tax_amount_currency' => $item['tax']['amount_currency'] ?? 'TRY',
                                    'tax_percent' => $item['tax']['subtotals'][0]['percent'] ?? 0,
                                    'taxable' => $item['tax']['subtotals'][0]['taxable'] ?? 0,
                                    'taxable_currency' => $item['tax']['subtotals'][0]['taxable_currency'] ?? 'TRY',
                                    'tax_total_amount' => $item['tax_totals'][0]['amount'] ?? 0,
                                ]
                            );
                        } catch (\Exception $e) {
                            Commandslog::create([
                                'command_name' => 'gidenefatura:kayit',
                                'status' => 'line_error',
                                'message' => $e->getMessage(),
                                'context' => json_encode([
                                    'fatura_uuid' => $invoice['uuid'] ?? null,
                                    'satir' => $item['name'] ?? null,
                                ]),
                                'logged_at' => now(),
                            ]);
                            continue;
                        }
                    }
                } catch (\Exception $e) {
                    Commandslog::create([
                        'command_name' => 'gidenefatura:kayit',
                        'status' => 'invoice_error',
                        'message' => $e->getMessage(),
                        'context' => json_encode([
                            'fatura_uuid' => $invoice['uuid'] ?? null,
                        ]),
                        'logged_at' => now(),
                    ]);
                    continue;
                }
            }

            $this->info('Giden faturalar başarıyla kaydedildi.');

            Commandslog::create([
                'command_name' => 'gidenefatura:kayit',
                'status' => 'success',
                'message' => 'Giden faturalar başarıyla kaydedildi.',
                'logged_at' => now(),
            ]);
        } catch (\Exception $e) {
            $this->error('Giden işlem sırasında hata oluştu.');
            Commandslog::create([
                'command_name' => 'gidenefatura:kayit',
                'status' => 'fatal_error',
                'message' => $e->getMessage(),
                'context' => json_encode([]),
                'logged_at' => now(),
            ]);
        }
    }
}
