<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | Luminus Education</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-slate-50 font-['Plus_Jakarta_Sans']">
    @include('siswa.partials.sidebar')

    <div class="p-6 sm:ml-64">
        <!-- Hero Section -->
        <div class="max-w-4xl mx-auto">
            <div class="relative bg-[#032038] rounded-3xl mb-8 overflow-hidden">
                <div class="absolute inset-0">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#696EFF]/20 to-[#F8ACFF]/20"></div>
                </div>

                <!-- Content -->
                <div class="relative z-10 px-8 py-6">
                    <div class="max-w-4xl mx-auto">
                        <div class="flex items-center space-x-4">
                            <!-- Icon -->
                            <div class="p-2.5 bg-white/10 backdrop-blur-sm rounded-xl border border-white/10">
                                <i
                                    class="fas fa-user-edit text-lg text-transparent bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] bg-clip-text"></i>
                            </div>

                            <!-- Title -->
                            <div>
                                <h1 class="text-2xl font-semibold text-white">
                                    Edit Profile
                                </h1>
                                <p class="text-sm text-white/70">
                                    Perbarui informasi profil Anda
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           



            <!-- Main Content -->
            <div class="max-w-4xl mx-auto">
                @if (session('success'))
                    <div id="successMessage"
                        class="flex items-center p-4 mb-6 bg-emerald-50 border-l-4 border-emerald-500 rounded-lg animate-fade-in">
                        <i class="fas fa-check-circle text-emerald-500 text-xl mr-3"></i>
                        <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Profile Form -->



                <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
                    <div class="p-8 border-b border-slate-100">
                        <div class="flex items-center space-x-6">
                            <div class="relative group">
                                <div class="w-24 h-24 rounded-xl overflow-hidden ring-4 ring-slate-50">
                                    <img id="preview"
                                        src="{{ Auth::user()->profile_picture_url ? asset('storage/' . Auth::user()->profile_picture_url) : (Auth::user()->gender == 'female' ? asset('images/default-female.png') : asset('images/default-male.png')) }}"
                                        alt="Profile" class="w-full h-full object-cover">
                                </div>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-slate-800">{{ Auth::user()->name }}</h2>
                                <p class="text-slate-500">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>

                    <form id="profileForm" action="{{ route('siswa.updateProfile') }}" method="POST"
                        enctype="multipart/form-data" class="p-8 space-y-6">
                        <div class="mb-4">
                            <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile
                                Picture</label>
                            <input type="file" name="profile_picture" id="profile_picture" class="mt-1 block w-full">
                            @if (Auth::user()->profile_picture_url)
                                <button type="button"
                                    onclick="document.getElementById('deleteProfilePictureForm').submit();"
                                    class="mt-2 text-red-600 hover:text-red-800">Hapus Foto Profil</button>
                            @endif
                        </div>
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Full Name -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Full Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="far fa-user text-slate-400"></i>
                                    </div>
                                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                                        class="block w-full pl-11 pr-4 py-3 bg-gray-100 border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">
                                    Email Address
                                    <span class="ml-1 text-amber-500" title="Email cannot be changed">
                                        <i class="fas fa-lock text-xs"></i>
                                    </span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="far fa-envelope text-slate-400"></i>
                                    </div>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                                        class="block w-full pl-11 pr-4 py-3 bg-gray-100 border-slate-200 rounded-xl text-slate-500 cursor-not-allowed select-none"
                                        readonly title="Email address cannot be changed" style="user-select: none;">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <i class="fas fa-ban text-slate-400"></i>
                                    </div>
                                </div>
                                <p class="mt-2 text-xs text-slate-500">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Email address cannot be modified for security reasons
                                </p>
                            </div>

                            <!-- Gender -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Gender</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-venus-mars text-slate-400"></i>
                                    </div>
                                    <input type="text" name="gender"
                                        value="{{ Auth::user()->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}"
                                        class="block w-full pl-11 pr-4 py-3 bg-gray-100 border-slate-200 rounded-xl text-slate-500 cursor-not-allowed select-none"
                                        readonly title="Gender cannot be changed" style="user-select: none;">
                                </div>
                            </div>

                            <!-- Nationality -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Nationality</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-globe text-slate-400"></i>
                                    </div>
                                    <input type="text" name="nationality"
                                        value="{{ old('nationality', Auth::user()->nationality) }}"
                                        class="block w-full pl-11 pr-4 py-3 bg-gray-100 border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                                @error('nationality')
                                    <p class="mt-2 text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- City -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">City</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-city text-slate-400"></i>
                                    </div>
                                    <input type="text" name="city"
                                        value="{{ old('city', Auth::user()->city) }}"
                                        class="block w-full pl-11 pr-4 py-3 bg-gray-100 border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                                @error('city')
                                    <p class="mt-2 text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Phone Number</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-phone text-slate-400"></i>
                                    </div>
                                    <input type="tel" name="phone"
                                        value="{{ old('phone', Auth::user()->phone) }}"
                                        class="block w-full pl-11 pr-4 py-3 bg-gray-100 border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        placeholder="+62">
                                </div>
                                @error('phone')
                                    <p class="mt-2 text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- My Occupation -->
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">My Occupation</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-briefcase text-slate-400"></i>
                                    </div>
                                    <input type="text" name="occupation"
                                        value="{{ old('occupation', Auth::user()->occupation) }}"
                                        class="block w-full pl-11 pr-4 py-3 bg-gray-100 border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                                @error('occupation')
                                    <p class="mt-2 text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Personal Goal -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Personal Goal</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-flag text-slate-400"></i>
                                    </div>
                                    <select name="personal_goal"
                                        class="block w-full pl-11 pr-4 py-3 bg-gray-100 border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors appearance-none">
                                        <option value="">Select your goal</option>
                                        <option value="mobile_developer"
                                            {{ old('personal_goal', Auth::user()->personal_goal) == 'mobile_developer' ? 'selected' : '' }}>
                                            Mobile Developer</option>
                                        <option value="web_developer"
                                            {{ old('personal_goal', Auth::user()->personal_goal) == 'web_developer' ? 'selected' : '' }}>
                                            Web Developer</option>
                                        <option value="ui_ux_designer"
                                            {{ old('personal_goal', Auth::user()->personal_goal) == 'ui_ux_designer' ? 'selected' : '' }}>
                                            UI/UX Designer</option>
                                        <option value="data_scientist"
                                            {{ old('personal_goal', Auth::user()->personal_goal) == 'data_scientist' ? 'selected' : '' }}>
                                            Data Scientist</option>
                                        <option value="devops_engineer"
                                            {{ old('personal_goal', Auth::user()->personal_goal) == 'devops_engineer' ? 'selected' : '' }}>
                                            DevOps Engineer</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-slate-400"></i>
                                    </div>
                                </div>
                                @error('personal_goal')
                                    <p class="mt-2 text-sm text-red-600"><i
                                            class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="flex justify-end pt-6">
                            <button type="submit" id="saveButton"
                                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <i class="fas fa-save mr-2"></i>
                                Save Changes
                            </button>
                        </div>
                    </form>

                    <form id="deleteProfilePictureForm" action="{{ route('siswa.deleteProfilePicture') }}"
                        method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>

        <!-- Custom Modal -->
        <div id="customModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
                <h2 class="text-xl font-semibold mb-4">Confirm Changes</h2>
                <p class="mb-6">Are you sure you want to save changes?</p>
                <div class="flex justify-end space-x-4">
                    <button id="cancelButton"
                        class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 transition-colors">Cancel</button>
                    <button id="confirmButton"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Confirm</button>
                </div>
            </div>
        </div>

        <!-- No Changes Modal -->
        <div id="noChangesModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
                <h2 class="text-xl font-semibold mb-4">No Changes Made</h2>
                <p class="mb-6">You have not made any changes to save.</p>
                <div class="flex justify-end">
                    <button id="closeNoChangesModal"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Close</button>
                </div>
            </div>
        </div>

        <script>
            const form = document.getElementById('profileForm');
            const saveButton = document.getElementById('saveButton');
            const customModal = document.getElementById('customModal');
            const noChangesModal = document.getElementById('noChangesModal');
            const cancelButton = document.getElementById('cancelButton');
            const confirmButton = document.getElementById('confirmButton');
            const closeNoChangesModal = document.getElementById('closeNoChangesModal');
            let formChanged = false;

            // Listen for input changes
            form.addEventListener('input', () => {
                formChanged = true;
            });

            // Listen for select element changes
            form.addEventListener('change', (e) => {
                if (e.target.tagName === 'SELECT' || e.target.type === 'file') {
                    formChanged = true;
                }
            });

            // Listen for profile picture changes
            document.getElementById('profile_picture').addEventListener('change', (e) => {
                formChanged = true;
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('preview');
                        preview.src = e.target.result;
                        preview.classList.add('scale-105');
                        setTimeout(() => preview.classList.remove('scale-105'), 300);
                    }
                    reader.readAsDataURL(e.target.files[0]);
                }
            });

            saveButton.addEventListener('click', (e) => {
                e.preventDefault();
                if (!formChanged) {
                    noChangesModal.classList.remove('hidden');
                    return;
                }
                customModal.classList.remove('hidden');
            });

            cancelButton.addEventListener('click', () => {
                customModal.classList.add('hidden');
            });

            confirmButton.addEventListener('click', () => {
                customModal.classList.add('hidden');
                form.submit();
            });

            closeNoChangesModal.addEventListener('click', () => {
                noChangesModal.classList.add('hidden');
            });

            // Hide success message after 4 seconds
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.classList.add('hidden');
                }, 4000);
            }
        </script>
</body>

</html>
