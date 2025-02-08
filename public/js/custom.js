/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */
 // $(document).ready(function() {
 //
 //
 //   });
   function coba() {
     getElementById('jumlah').append("<p>jQuery is Amazing...</p>");
   }

   function stok() {
    	var tes = document.getElementById("barang").value;
            document.getElementById("jumlah").value=tes;
            document.getElementById('ket').append("max jumlahnya adalah");
    }

   $("#nama_laptop").click(function() {
     $("#jumlah").after("<p>jQuery is Amazing...</p>");
   });

   $("#nama_barang").click(function() {
     $("#jumlah").after("<p>jQuery is Amazing...</p>");
   })


   document.addEventListener("DOMContentLoaded", function () {
    // Mengambil semua tombol pembuka modal
    let openButtons = document.querySelectorAll(".btn-open-modal");
    let closeButtons = document.querySelectorAll(".btn-close-modal");

    // Menampilkan modal saat tombol "Lihat Kronologi" diklik
    openButtons.forEach(button => {
        button.addEventListener("click", function () {
            let modalId = this.getAttribute("data-modal");
            let modal = document.getElementById(modalId);
            
            if (modal) {
                modal.style.display = "block";
                document.body.classList.add("modal-open");
            }
        });
    });

    // Menutup modal saat tombol "Tutup" diklik
    closeButtons.forEach(button => {
        button.addEventListener("click", function () {
            let modal = this.closest(".modal");

            if (modal) {
                modal.style.display = "none";
                document.body.classList.remove("modal-open");
            }
        });
    });

    // Menutup modal jika klik di luar area modal
    window.addEventListener("click", function (event) {
        document.querySelectorAll(".modal").forEach(modal => {
            if (event.target === modal) {
                modal.style.display = "none";
                document.body.classList.remove("modal-open");
            }
        });
    });
});


