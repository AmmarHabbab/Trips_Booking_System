<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="h-screen flex">
        <!-- sidebar -->
        <div class="bg-gray-800 text-white flex-none w-64 p-4">
            <div class="text-2xl font-semibold mb-1">
                Dashboard
            </div>
            <nav>
                <ul>
                    <li class="mb-3">
                        <a href="#" class="block p-2 rounded hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 11h18M3 15h18M3 19h18" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="block p-2 rounded hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                            المنشورات
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="block p-2 rounded hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-2a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h2" />
                            </svg>
                            التصنيفات
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="block p-2 rounded hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2m14 0V9a2 2 0 012-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h2" />
                            </svg>
                            Media
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="block p-2 rounded hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            المستخدمين
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="block p-2 rounded hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Appearance
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="block p-2 rounded hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Plugins
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="block p-2 rounded hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 0121 9z" />
                            </svg>
                            Tools
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="block p-2 rounded hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 11h18M3 15h18M3 19h18" />
                            </svg>
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- main content -->
        <div class="flex-1 p-4">
            <!-- your main content here -->
        </div>
    </div>
</body>
</html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Dropdown</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="fixed top-0 left-0 bottom-0 w-64 bg-gray-100">
        <div class="space-y-4">
            <a href="#" class="block px-4 py-2 rounded-md text-gray-700 hover:bg-gray-200">الرئيسية</a>
            <a href="#" class="block px-4 py-2 rounded-md text-gray-700 hover:bg-gray-200">من نحن</a>
            <a href="#" class="block px-4 py-2 rounded-md text-gray-700 hover:bg-gray-200">اتصل بنا</a>
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="block w-full px-4 py-2 text-left text-gray-700 rounded-md hover:bg-gray-200">
                    تصنيفات
                    <i class="ml-1 fa-solid fa-caret-down"></i>
                </button>
                <div x-show="open" x-cloak class="absolute left-0 w-64 mt-1 rounded-md bg-white shadow-lg z-50">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">أضف</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">تعديل</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">حذف</a>
                </div>
            </div>
        </div>
    </div>
    <div class="ml-64">
        <!-- Main content goes here -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.0/dist/alpine.min.js"></script>
</body>
</html> --}}
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="bg-gray-200 min-h-screen flex">
        <!-- Sidebar -->
        <div class="bg-white w-64 p-6">
            <div class="flex items-center space-x-4">
                <img class="h-10 w-10 rounded-full object-cover" src="https://via.placeholder.com/150" alt="Profile image">
                <h1 class="text-xl font-bold">John Doe</h1>
            </div>

            <nav class="mt-10">
                <div class="mb-4">
                    <a href="#" class="flex items-center space-x-4 text-gray-700 font-semibold px-4 py-2 rounded-lg hover:bg-gray-200">
                        <span class="material-icons">dashboard</span>
                        <span>Dashboard</span>
                    </a>
                </div>

                <div class="mb-4">
                    <a href="#" class="flex items-center space-x-4 text-gray-700 font-semibold px-4 py-2 rounded-lg hover:bg-gray-200">
                        <span class="material-icons">article</span>
                        <span>Posts</span>
                    </a>
                </div>

                <div class="mb-4">
                    <div x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-4 text-gray-700 font-semibold px-4 py-2 rounded-lg hover:bg-gray-200">
                            <span class="material-icons">category</span>
                            <span>Categories</span>
                        </button>
                        <div x-show="open" @click.away="open = false" class="mt-2 space-y-2 px-7">
                            <a href="#" class="block text-sm text-gray-700">Programming</a>
                            <a href="#" class="block text-sm text-gray-700">Design</a>
                            <a href="#" class="block text-sm text-gray-700">Business</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1 p-6">
            <h2 class="text-2xl font-bold mb-6">Welcome to your dashboard</h2>
            <!-- Main content goes here -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.7.0/dist/cdn.min.js"></script>
</body>
</html> --}}