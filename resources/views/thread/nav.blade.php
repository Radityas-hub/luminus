
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
            <nav class="mb-6 flex items-center space-x-2 text-sm">
            <a href="{{ route('forums.index') }}"
                class="text-[#696EFF] hover:text-[#4A4FFF] transition-colors duration-200">
                <i class="fas fa-home"></i>
                Forum
            </a>
            <i class="fas fa-chevron-right text-gray-400"></i>
            <span class="text-gray-600">{{ $thread->title }}</span>
        </nav>

</body>
</html>