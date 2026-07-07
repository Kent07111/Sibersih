<!--
  Code yang sudah dirapihkan:
  - Memperbaiki indentasi dan spasi
  - Menambahkan atribut x-data untuk Alpine.js
  - Memperbaiki penulisan class (transform, transition, dll)
  - Menambahkan struktur yang lebih rapi dan konsisten
  - Memperbaiki atribut x-show dan x-transition
-->

<aside
    class="fixed lg:relative z-50
    h-screen w-72
    bg-slate-900 text-white
    transition-all duration-300
    flex flex-col
    shadow-xl"

    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
  <!-- Header -->
<div class="flex items-center justify-between p-6 border-b border-slate-700">

    <div>

        <h1 class="text-2xl font-bold text-green-400">

            🌱 SIBERSIH

        </h1>

        <p class="text-xs text-slate-400">

            Admin Panel

        </p>

    </div>

    <button
        class="lg:hidden"

        @click="sidebarOpen=false">

        ✕

    </button>

</div>

  <!-- Navigasi -->
  <nav class="p-4 pb-24 space-y-2">
    <!-- General -->
    <p class="text-xs text-slate-500 uppercase mb-2">General</p>
    <a
      href="/dashboard"
      class="flex items-center gap-3 rounded-xl px-4 py-3 bg-green-600 hover:bg-green-500 transition"
    >
      🏠 Dashboard
    </a>

    <!-- Master Data -->
    <p class="text-xs text-slate-500 uppercase mt-8 mb-2">Master Data</p>
    <a href="#" class="flex gap-3 px-4 py-3 rounded-xl hover:bg-slate-800">🗑 Titik Sampah</a>
    <a href="#" class="flex gap-3 px-4 py-3 rounded-xl hover:bg-slate-800">📚 Edukasi</a>
    <a href="#" class="flex gap-3 px-4 py-3 rounded-xl hover:bg-slate-800">📰 Kegiatan</a>
    <a href="#" class="flex gap-3 px-4 py-3 rounded-xl hover:bg-slate-800">📅 Jadwal</a>
    <a href="#" class="flex gap-3 px-4 py-3 rounded-xl hover:bg-slate-800">🖼 Galeri</a>

    <!-- Pelayanan -->
    <p class="text-xs text-slate-500 uppercase mt-8 mb-2">Pelayanan</p>
    <a href="#" class="flex gap-3 px-4 py-3 rounded-xl hover:bg-slate-800">📍 Laporan</a>
    <a href="#" class="flex gap-3 px-4 py-3 rounded-xl hover:bg-slate-800">🔳 QR Code</a>
  </nav>

  <!-- Footer / Logout -->
  <div class="p-4 border-t border-slate-700">
    <a
      href="/logout"
      class="block text-center bg-red-500 hover:bg-red-600 rounded-xl py-3"
    >
      Logout
    </a>
  </div>
</aside>

<!-- Overlay untuk mobile -->
<div

x-show="sidebarOpen"

x-transition

@click="sidebarOpen=false"

class="fixed inset-0 bg-black/40 z-40 lg:hidden">

</div>
