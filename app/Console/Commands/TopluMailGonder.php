<?php

namespace App\Console\Commands;

use App\Mail\ToplugonderMail;
use App\Models\Cariler;
use App\Models\Toplumail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TopluMailGonder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toplumail:gonder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Carileri gruplara ayırıp toplu mail gönderir.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $toplumail = Toplumail::latest()->first(); // En son kaydı çek

        if (!$toplumail) {
            $this->error('Toplu mail içeriği bulunamadı!');
            return;
        }

        // E-posta adresi dolu olanları çek
        $cariler = Cariler::whereNotNull('eposta')
        ->where('firma_sektor', $toplumail->firma_sektor)->pluck('eposta')->toArray();

        // 20'lik gruplara ayır
        $chunks = array_chunk($cariler, 20);
        $hours = 0;

        foreach ($chunks as $group) {
            Mail::to($group)->later(now()->addHours($hours), new ToplugonderMail($toplumail));
            $hours++; // Her grup için gecikmeyi artır
        }

        $this->info('Toplu mail gönderimi başlatıldı.');
    }
}

