<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sidebar</title>
  <!-- <link rel="stylesheet" href="css/style.css" /> -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script
    defer
    src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    [x-cloak] {
      display: none;
    }
  </style>
</head>

<body class="font-sans antialiased bg-gray-50 transition-all duration-300" x-data="{ sidebarOpen: false }">
  <div class="">
    <!-- Sidebar Overlay -->
    <div
      x-show="sidebarOpen"
      class="fixed inset-0 z-40 bg-black bg-opacity-50 transition-opacity"
      @click="sidebarOpen = false"
      x-transition:enter="transition-opacity ease-linear duration-300"
      x-transition:leave="transition-opacity ease-linear duration-300"
      x-cloak></div>

    <!-- Sidebar -->
    <div
      x-show="sidebarOpen"
      class="fixed top-0 left-0 z-50 w-64 h-full bg-white shadow-lg transition-transform duration-300"
      x-transition:enter="transform transition-transform ease-in-out duration-300"
      x-transition:enter-start="-translate-x-full"
      x-transition:enter-end="translate-x-0"
      x-transition:leave="transform transition-transform ease-in-out duration-300"
      x-transition:leave-start="translate-x-0"
      x-transition:leave-end="-translate-x-full"
      style="display: none"
      x-bind:style="sidebarOpen ? 'display: block;' : 'display: none;'"
      x-cloak>
      <aside
        id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 border-r">
          <ul class="space-y-1 font-medium">
            <li>
              <a href="/facerecogeneration_benar/revisi/attendance.php"
                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 <?= strpos($currentUrl, 'dashboard') !== false ? 'bg-zinc-900 text-white shadow hover:bg-zinc-800' : 'hover:bg-accent' ?> h-9 px-4 py-2 group">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gauge w-5 h-5 <?= strpos($currentUrl, 'dashboard') !== false ? 'text-white' : 'text-gray-500' ?> transition duration-75">
                  <path d="m12 14 4-4" />
                  <path d="M3.34 19a10 10 0 1 1 17.32 0" />
                </svg>
                <span class="ms-3">Dashboard</span>
              </a>
            </li>
            <li>
              <a href="/facerecogeneration_benar/revisi/student.php"
                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 <?= strpos($currentUrl, 'dashboard') !== false ? 'bg-zinc-900 text-white shadow hover:bg-zinc-800' : 'hover:bg-accent' ?> h-9 px-4 py-2 group">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gauge w-5 h-5 <?= strpos($currentUrl, 'dashboard') !== false ? 'text-white' : 'text-gray-500' ?> transition duration-75">
                  <path d="m12 14 4-4" />
                  <path d="M3.34 19a10 10 0 1 1 17.32 0" />
                </svg>
                <span class="ms-3">siswa</span>
              </a>
            </li>
          </ul>
        </div>
      </aside>
    </div>

    <!-- Breadcrumb -->
    <div
      class="fixed top-0 inset-x-0 z-20 bg-white border-y px-4 sm:px-6 lg:px-8 dark:bg-neutral-800 dark:border-neutral-700">
      <div class="flex items-center py-2">
        <!-- Navigation Toggle -->
        <button
          type="button"
          @click="sidebarOpen = !sidebarOpen"
          class="size-8 flex justify-center items-center gap-x-2 border border-gray-200 text-gray-800 hover:text-gray-500 rounded-lg focus:outline-none focus:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500">
          <span class="sr-only">Toggle Navigation</span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="lucide lucide-panel-right-close shrink-0 size-4">
            <rect width="18" height="18" x="3" y="3" rx="2" />
            <path d="M15 3v18" />
            <path d="m8 9 3 3-3 3" />
          </svg>
        </button>

        <!-- Main Content -->
        <div class="flex-1 transition-all duration-300">
          <!-- Breadcrumb -->
          <ol class="ms-3 flex items-center whitespace-nowrap">
            <li class="flex items-center text-sm text-gray-800 dark:text-neutral-400">
              <a href="/facerecogeneration_benar/revisi/attendance.php" class="hover:underline">
                Absensi Antartika
              </a>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="lucide lucide-chevron-right shrink-0 mx-3 overflow-visible size-4 text-gray-400 dark:text-neutral-500">
                <path d="m9 18 6-6-6-6" />
              </svg>
            </li>

            <li
              class="text-sm font-semibold text-gray-800 truncate dark:text-neutral-400"
              aria-current="page">
            </li>
          </ol>
          <!-- End Breadcrumb -->
        </div>
      </div>
    </div>
    <!-- End Breadcrumb -->
  </div>
</body>

</html>