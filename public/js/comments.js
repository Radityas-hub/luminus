function toggleReplyForm(commentId, userName) {
    const form = document.getElementById(`reply-form-${commentId}`);
    form.classList.toggle('hidden');
    const textarea = form.querySelector('textarea');
    textarea.value = `@${userName} `;
    textarea.focus();
}

function toggleMenu(commentId) {
    const menu = document.getElementById(`menu-${commentId}`);
    menu.classList.toggle('hidden');
}

function openEditModal(commentId, commentBody) {
    const modal = document.getElementById('editCommentModal');
    const form = document.getElementById('editCommentForm');
    const textarea = document.getElementById('editBody');
    
    form.action = `/comments/${commentId}`;
    textarea.value = commentBody;
    
    modal.classList.remove('hidden');
}