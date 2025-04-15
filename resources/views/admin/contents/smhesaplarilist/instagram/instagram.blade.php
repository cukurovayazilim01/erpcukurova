@extends('admin.layouts.app')
@section('title')
İnstagram
@endsection
@section('contents')
@section('topheader')
İnstagram
@endsection
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }
  body {
    font-family: 'Inter', sans-serif;
  }
  .container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 30px 20px;
  }
  .profile-header {
    display: flex;
    gap: 40px;
    align-items: center;
    padding-bottom: 30px;
    border-bottom: 1px solid #333;
  }
  .profile-pic {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid #333;
  }
  .profile-pic img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .profile-info {
    flex: 1;
  }
  .profile-info h2 {
    font-size: 20px;
    margin-bottom: 10px;
  }
  .stats {
    display: flex;
    gap: 30px;
    margin-bottom: 15px;
  }
  .stats div {
    font-size: 15px;
  }
  .bio {
    font-size: 14px;
    line-height: 1.5;
  }
  .bio a {
    color: #00aef0;
    text-decoration: none;
  }
  .story-highlights {
    display: flex;
    gap: 20px;
    padding: 25px 0;
    border-bottom: 1px solid #333;
  }
  .highlight {
    text-align: center;
  }
  .highlight-icon {
    width: 75px;
    height: 75px;
    border-radius: 50%;
    background-color: #111;
    border: 2px solid #00aef0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    color: #00aef0;
    font-weight: bold;
  }
  .highlight-label {
    font-size: 12px;
    margin-top: 5px;
  }
  .tabs {
    display: flex;
    justify-content: center;
    gap: 40px;
    padding: 20px 0;
    border-bottom: 1px solid #333;
    font-size: 14px;
  }
  .tabs div {
    cursor: pointer;
    opacity: 0.8;
  }
  .tabs div:hover {
    opacity: 1;
  }
  .posts-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2px;
  }
  .post img {
    width: 100%;
    display: block;
    object-fit: cover;
  }
  .top-bar {
      position: absolute;
      top: 20px;
      right: 40px;
      display: flex;
      gap: 10px;
    }
    .top-bar input {
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      font-size: 14px;
    }
    .top-bar button {
      padding: 5px 10px;
      background-color: #00aef0;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .top-bar button:hover {
      background-color: #007ca8;
    }
    /* Responsive */
    @media (max-width: 768px) {
      .profile-header {
        flex-direction: column;
        align-items: flex-start;
      }

      .profile-pic img {
        margin-bottom: 20px;
      }

      .posts-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 480px) {
      .posts-grid {
        grid-template-columns: repeat(1, 1fr);
      }

      .top-bar {
        flex-direction: column;
        top: 10px;
        right: 10px;
      }
    }
</style>
<style>
.insta-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.85);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  overflow: auto;
}

.modal-inner {
  display: flex;
  max-width: 900px;
  width: 90%;
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
}

.modal-image {
  flex: 1;
  background: #000;
}

.modal-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.modal-content {
  width: 350px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 10px;
  background: #fff;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-weight: bold;
}

.close-modal {
  cursor: pointer;
  font-size: 20px;
  color: #888;
}

.modal-caption {
  margin: 10px 0;
  font-size: 14px;
}

.modal-stats {
  font-size: 13px;
  color: #555;
  margin-bottom: 10px;
}

.modal-comments {
  flex: 1;
  font-size: 13px;
  overflow-y: auto;
  max-height: 150px;
  margin-bottom: 10px;
}

.modal-footer {
  border-top: 1px solid #eee;
  padding-top: 10px;
}

.modal-footer input {
  width: 100%;
  padding: 8px;
  font-size: 13px;
  border: none;
  outline: none;
}
</style>
</head>
<body>
    <!-- Sağ Üst Input ve Buton -->
   <form action="{{ route('getInstagramBusinessData') }}" method="GET">
    <div class="top-bar">
        <input type="text" placeholder="Kullanıcı adı girin" name="user_name" id="user_name" value="{{ request('user_name') }}">
        <button type="submit">Değiştir</button>
    </div>
</form>

<div class="container">
    @if(isset($data['error']))
        <div class="alert alert-danger">{{ $data['error'] }}</div>
    @else
    <!-- Profil Başlık Alanı -->
    <div class="profile-header">
        <div class="profile-pic">
            <img src="{{ $data['profile_picture_url'] ?? 'https://i.imgur.com/0L7DdYt.jpeg' }}" alt="Profil Fotoğrafı">
        </div>
        <div class="profile-info">
            <h2 id="username">{{ request('user_name') }}</h2>
            <div class="stats">
                <div><strong>{{ $data['media_count'] ?? 0 }}</strong> gönderi</div>
                <div><strong>{{ $data['followers'] ?? 0 }}</strong> takipçi</div>
                <div><strong>{{ $data['follows'] ?? '-' }}</strong> takip</div>
            </div>
            <div class="bio">
                <strong>{{ $data['name'] ?? 'Çukurova Marka Patent Kalite' }}</strong><br>
                {{ $data['biography'] ?? 'Ürün/Hizmet' }}<br>
                @if(isset($data['website']))
                    <a href="{{ $data['website'] }}" target="_blank">{{ $data['website'] }}</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Story Highlight Alanı -->
    <div class="story-highlights">
        <div class="highlight"><div class="highlight-icon">👥</div><div class="highlight-label">BİZDEN KARE...</div></div>
        <div class="highlight"><div class="highlight-icon">🤝</div><div class="highlight-label">REFERANSLAR</div></div>
        <div class="highlight"><div class="highlight-icon">🔖</div><div class="highlight-label">İSO Belgeleri</div></div>
        <div class="highlight"><div class="highlight-icon">🎓</div><div class="highlight-label">EĞİTİM</div></div>
        <div class="highlight"><div class="highlight-icon">➕</div><div class="highlight-label">Yeni</div></div>
    </div>

    <!-- Sekmeler -->
   <div class="tabs">
    <div class="tab" data-tab="posts">📷 GÖNDERİLER</div>
    <div class="tab" data-tab="reels">🎞 REELS</div>
    <div class="tab" data-tab="saved">📌 KAYDEDİLENLER</div>
    <div class="tab" data-tab="tagged"># ETİKETLENENLER</div>
</div>

    <!-- Gönderiler -->
    <!-- Gönderiler -->
<div class="posts-grid tab-content" id="posts" >
    @foreach($data['media'] ?? [] as $media)
        @if($media['media_type'] !== 'VIDEO') <!-- Reels değilse göster -->
            <div class="post"  data-likes="{{ $media['like_count'] ?? '-' }}"
     data-caption="{{ $media['caption'] ?? 'Açıklama yok' }}"

     data-comments="{{ json_encode($media['comments']['data'] ?? []) }}">
                @if(isset($media['media_url']))
                    <img src="{{ $media['media_url'] }}" alt="Gönderi">
                @endif
            </div>
        @endif
    @endforeach
</div>

<!-- Reels -->
<div class="posts-grid tab-content" id="reels" style="display: none;">
    @foreach($data['media'] ?? [] as $media)
        @if($media['media_type'] === 'VIDEO') <!-- Sadece Reels olanlar -->
            <div class="post"  data-likes="{{ $media['like_count'] ?? '-' }}"
     data-caption="{{ $media['caption'] ?? 'Açıklama yok' }}"

     data-comments="{{ json_encode($media['comments']['data'] ?? []) }}">
                @if(isset($media['media_url']))
                    <video controls style="width: 100%;">
                        <source src="{{ $media['media_url'] }}" type="video/mp4">
                        Tarayıcınız video etiketini desteklemiyor.
                    </video>
                @endif
            </div>
        @endif
    @endforeach
</div>

    @endif
</div>


<!-- MODAL -->
<div id="instaModal" class="insta-modal" style="display: none;">
    <div class="modal-inner">
        <div class="modal-image">
            <img id="instaModalImage" src="" alt="Gönderi">
        </div>
        <div class="modal-content">
            <div class="modal-header">
                <strong id="instaProfile">{{ request('user_name') }}</strong>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-caption">
                <p id="instaCaption">Gönderi açıklaması buraya gelecek...</p>
            </div>
            <div class="modal-stats">
                <span id="instaLikes">❤️ 0 beğeni</span>
            </div>
            <div class="modal-comments">
                <!-- Yorumlar buraya gelecek -->
            </div>
            <div class="modal-footer">
                <form action="#" method="POST">
                    @csrf
                    <input type="hidden" name="comment_id" id="modalCommentId">
                    <input type="text" name="message" placeholder="Yorum ekle..." required>
                    <button type="submit">Yanıtla</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- TAB GEÇİŞİ -->
<script>
document.querySelectorAll(".tab").forEach(tab => {
    tab.addEventListener("click", function () {
        let tabName = this.dataset.tab;
        document.querySelectorAll(".tab-content").forEach(tc => tc.style.display = "none");
        document.getElementById(tabName).style.display = "grid";
    });
});
</script>

<!-- MODAL AÇMA -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("instaModal");
    const modalImage = document.getElementById("instaModalImage");
    const closeModal = document.querySelector(".close-modal");
    const caption = document.getElementById("instaCaption");
    const likes = document.getElementById("instaLikes");
    const commentsContainer = document.querySelector(".modal-comments");
    const commentIdInput = document.getElementById("modalCommentId");

    document.querySelectorAll(".post img, .post video").forEach(media => {
        media.addEventListener("click", function () {
            const post = media.closest(".post");
            const comments = JSON.parse(post.getAttribute("data-comments") || "[]");

            modal.style.display = "flex";
            modalImage.src = media.tagName === "VIDEO" ? media.querySelector("source").src : media.src;
            caption.textContent = post.getAttribute("data-caption") || "Açıklama yok.";
            likes.textContent = `❤️ ${post.getAttribute("data-likes") || "0"} beğeni`;

            let commentsHtml = "";
            comments.forEach(comment => {
                commentsHtml += `
                    <div class="comment">
                        <p><strong>${comment.username ?? 'Kullanıcı'}:</strong> ${comment.text}</p>
                        <form method="POST" action="#">
                            @csrf
                            <input type="hidden" name="comment_id" value="${comment.id}">
                            <input type="text" name="message" placeholder="Yanıtla..." required>
                            <button type="submit">Yanıtla</button>
                        </form>
                        <form method="POST" action="#">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="comment_id" value="${comment.id}">
                            <button type="submit" onclick="return confirm('Yorumu silmek istediğinize emin misiniz?')">Sil</button>
                        </form>
                    </div>
                `;
            });

            commentsContainer.innerHTML = commentsHtml || "<em>Henüz yorum yok.</em>";
        });
    });

    closeModal.addEventListener("click", () => modal.style.display = "none");
    window.addEventListener("click", (e) => {
        if (e.target === modal) modal.style.display = "none";
    });
});
</script>

@endsection
