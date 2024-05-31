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
