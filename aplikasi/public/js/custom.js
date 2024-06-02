/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";

// Menggunakan event listener untuk menangani klik pada tombol hapus
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-button')) {
        var categoryId = event.target.dataset.categoryId;
        if (confirm("Apakah Anda yakin ingin menghapus kategori ini?")) {
            deleteCategory(categoryId);
        }
    }
});

// Fungsi untuk menghapus kategori
function deleteCategory(id) {
    // Dapatkan token CSRF dari meta tag
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Kirim permintaan AJAX untuk menghapus kategori
    fetch("/admin/categories/" + id, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.status == "success") {
            alert("Kategori berhasil dihapus.");
            // Reload halaman
            location.reload();
        } else {
            alert("Gagal menghapus kategori.");
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert("Terjadi kesalahan saat menghapus kategori.");
    });
}

// Fungsi untuk menghapus peran
function deleteRole(id) {
    // Dapatkan token CSRF dari meta tag
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Kirim permintaan AJAX untuk menghapus peran
    fetch("/admin/roles/" + id, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.status == "success") {
            alert("Peran berhasil dihapus.");
            // Reload halaman
            location.reload();
        } else {
            alert("Gagal menghapus peran.");
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert("Terjadi kesalahan saat menghapus peran.");
    });
}

// Fungsi untuk menghapus pengguna
function deleteUser(id) {
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Kirim permintaan AJAX untuk menghapus pengguna
    fetch("/admin/users/" + id, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Terjadi kesalahan saat menghapus pengguna.'); // Handling kesalahan jika status respons tidak ok
        }
        return response.json();
    })
    .then(data => {
        if (data.status == "success") {
            alert("Pengguna berhasil dihapus.");
            // Reload halaman
            location.reload();
        } else {
            throw new Error('Gagal menghapus pengguna.');
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert("Terjadi kesalahan saat menghapus pengguna.");
    });
}

// Fungsi untuk menghapus foto
function deletePhoto(id) {
    // Dapatkan token CSRF dari meta tag
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Kirim permintaan AJAX untuk menghapus foto
    fetch("/admin/photos/" + id, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.status == "success") {
            alert("Foto berhasil dihapus.");
            // Reload halaman
            location.reload();
        } else {
            alert("Gagal menghapus foto.");
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert("Terjadi kesalahan saat menghapus foto.");
    });
}

// Fungsi untuk menghapus video
function deleteVideo(id) {
    // Dapatkan token CSRF dari meta tag
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Kirim permintaan AJAX untuk menghapus video
    fetch("/admin/videos/" + id, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            alert("Video berhasil dihapus.");
            // Reload halaman
            location.reload();
        } else {
            alert("Gagal menghapus video.");
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert("Terjadi kesalahan saat menghapus video.");
    });
}

// Fungsi untuk menghapus slider
function deleteSlider(id) {
    // Dapatkan token CSRF dari meta tag
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Kirim permintaan AJAX untuk menghapus slider
    fetch("/admin/sliders/" + id, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            alert("Slider berhasil dihapus.");
            // Reload halaman
            location.reload();
        } else {
            alert("Gagal menghapus slider.");
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert("Terjadi kesalahan saat menghapus slider.");
    });
}

// Fungsi untuk menghapus event
function deleteEvent(id) {
    // Dapatkan token CSRF dari meta tag
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Kirim permintaan AJAX untuk menghapus event
    fetch("/admin/events/" + id, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.status == "success") {
            alert("Event berhasil dihapus.");
            // Reload halaman
            location.reload();
        } else {
            alert("Gagal menghapus event.");
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert("Terjadi kesalahan saat menghapus event.");
    });
}

// Fungsi untuk menghapus tag
function deleteTag(id) {
    // Dapatkan token CSRF dari meta tag
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Kirim permintaan AJAX untuk menghapus tag
    fetch("/admin/tags/" + id, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.status == "success") {
            alert("Tag berhasil dihapus.");
            // Reload halaman
            location.reload();
        } else {
            alert("Gagal menghapus tag.");
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert("Terjadi kesalahan saat menghapus tag.");
    });
}


// Fungsi untuk menghapus postingan
function deletePost(id) {
    // Dapatkan token CSRF dari meta tag
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Kirim permintaan AJAX untuk menghapus postingan
    fetch("/admin/posts/" + id, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.status == "success") {
            alert("Postingan berhasil dihapus.");
            // Reload halaman
            location.reload();
        } else {
            alert("Gagal menghapus postingan.");
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert("Terjadi kesalahan saat menghapus postingan.");
    });
}