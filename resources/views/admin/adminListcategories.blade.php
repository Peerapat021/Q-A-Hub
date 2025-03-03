<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome2.css') }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('หน้าจัดการหมวดหมู่') }}
            </h2>
        </x-slot>

        <div class="content p-6">
            @if (session('success'))
                <div class="alert alert-success mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6">
                <form action="{{ route('posts.index') }}" method="GET">
                    <div class="flex items-center">
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="form-input block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                            placeholder="ค้นหาหมวดหมู่...">
                        <button type="submit"
                            class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            ค้นหา
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">{{ __('รายการหมวดหมู่') }}</h1>
                <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                                รหัส</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                                ชื่อหมวดหมู่</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                                ผู้สร้าง</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                                วันที่</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                                การดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($categories as $category)
                            <tr class="hover:bg-gray-50 transition ease-in-out duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $category->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $category->category_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    @if ($category->user)
                                        {{ $category->user->name }}
                                    @else
                                        Unknown
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    @if ($category->created_at)
                                        {{ $category->created_at->format('Y-m-d H:i') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                                    <!-- View Button -->
                                    <a href="{{ route('categories.showPosts', $category->id) }}"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                        รายละเอียด
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        แก้ไข
                                    </a>

                                    <!-- Delete Button -->
                                    <form id="del_form_{{ $category->id }}" class="inline-block"
                                        action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button id="del_btn_{{ $category->id }}" type="submit"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            ลบ
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </x-app-layout>

</body>

</html>

<script>
    document.querySelectorAll('button[id^="del_btn_"]').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const categoryId = this.id.split('_')[2];
            const form = document.getElementById(`del_form_${categoryId}`);

            Swal.fire({
                title: "คุณแน่ใจว่าจะลบหมวดหมู่นี้หรือไม่?",
                text: "ข้อมูลนี้จะถูกลบออกและไม่สามารถกู้คืนได้",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "ต้องการ",
                cancelButtonText: "ยกเลิก"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const tableRows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('input', function() {
            const query = searchInput.value.toLowerCase();

            tableRows.forEach(row => {
                const cells = row.querySelectorAll('td');
                let matches = false;

                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(query)) {
                        matches = true;
                    }
                });

                if (matches) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>