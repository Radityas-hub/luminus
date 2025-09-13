<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="editCommentModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
    <div class="min-h-screen px-4 text-center">
        <div class="inline-block align-middle min-w-[500px] max-w-lg w-full bg-white rounded-2xl px-6 py-8 text-left shadow-xl transform transition-all">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-gray-800">Edit Comment</h3>
                <button type="button" class="text-gray-400 hover:text-gray-600 transition-colors" onclick="closeEditModal()">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="editCommentForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="editBody" class="block text-sm font-medium text-gray-700 mb-1">Comment</label>
                        <textarea id="editBody" name="body" rows="4" 
                                  class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl focus:outline-none focus:border-[#696EFF] focus:ring-1 focus:ring-[#696EFF] transition-all duration-200"
                                  required></textarea>
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" class="px-6 py-2.5 text-gray-600 hover:bg-gray-100 font-medium rounded-xl transition-all duration-200" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] text-white font-medium rounded-xl hover:shadow-lg hover:shadow-[#696EFF]/25 transition-all duration-300">Update Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>