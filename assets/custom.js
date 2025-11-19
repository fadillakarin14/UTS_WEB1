// assets/custom.js

function validateLoginForm() {
  // ambil elemen
  var email = document.getElementById('email').value.trim();
  var password = document.getElementById('password').value;

  // validasi sederhana menggunakan if
  if (email === '') {
    alert('Email harus diisi!');
    return false; // batalkan submit
  }
  if (password === '') {
    alert('Password harus diisi!');
    return false;
  }
  // contoh tambahan: cek format email sederhana
  if (email.indexOf('@') === -1 || email.indexOf('.') === -1) {
    alert('Format email tampaknya tidak valid.');
    return false;
  }
  // jika lulus semua, form akan dikirim (server-side masih akan cek)
  return true;
}
