<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Recommender</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/questions.js') }}"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>
<style>
    body {
        font-family: 'Poppins', sans-serif !important;
    }
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #fff;
    }

    ::-webkit-scrollbar-thumb {
        background: #696EFF;
        border-radius: 8px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #696EFF;
        opacity: 0.7;
    }
</style>
<body style="background: #f1f2f6">
    <div class="w-full md:w-[80%] mx-auto h-screen flex items-center justify-center">
        <div class="w-full h-full md:p-3 flex flex-col">
            <div class="flex justify-between py-5 px-6 border-b bg-[#052742] md:rounded-t-2xl items-center">
                <div class="flex justify-center w-fit items-center gap-x-3">
                    <img src="{{ asset('images/ai.png') }}" alt="Bot Avatar" class="w-10 aspect-square rounded-full">
                    <h1 class="text-xl text-white font-semibold">Lumin<span
                            class="bg-gradient-to-r from-[#696eff] to-[#f8acff] text-transparent bg-clip-text">AI</span>
                    </h1>
                </div>
                <div class="hidden md:flex justify-center gap-x-3">
                    <button onclick="resetChat()"
                        class="w-fit flex justify-center items-center gap-x-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span>Reset Chat</span>
                    </button>
                    <a class="w-10 aspect-square bg-white text-[#101010] flex justify-center items-center rounded-lg hover:bg-transparent hover:border hover:border-white hover:text-white"
                        href="{{ ('/') }}"><button class="w-full h-full" title="close"><i
                                class="fa-solid fa-x"></i></button></a>
                </div>
                <div class="md:hidden">
                    <button id="mobileMenuButton"
                        class="w-10 aspect-square bg-white text-[#101010] flex justify-center items-center rounded-lg hover:bg-transparent hover:border hover:border-white hover:text-white">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
                    <div id="mobileMenu" class="hidden absolute right-4 mt-2 w-48 bg-white rounded-lg  py-2">
                        <button onclick="resetChat()" class="w-full px-4 py-2 text-left text-red-600 hover:bg-gray-100">
                            <i class="fa-solid fa-rotate-left mr-2"></i>Reset Chat
                        </button>
                        <a href="" class="block px-4 py-2 text-[#101010] hover:bg-gray-100">
                            <i class="fa-solid fa-x mr-2"></i>Close
                        </a>
                    </div>
                </div>
                <script>
                    document.getElementById('mobileMenuButton').addEventListener('click', function() {
                        document.getElementById('mobileMenu').classList.toggle('hidden');
                    });

                    // Close menu when clicking outside
                    document.addEventListener('click', function(event) {
                        const menu = document.getElementById('mobileMenu');
                        const button = document.getElementById('mobileMenuButton');
                        if (!button.contains(event.target) && !menu.contains(event.target)) {
                            menu.classList.add('hidden');
                        }
                    });
                </script>

            </div>
            <div class="bg-white h-full md:h-auto pt-3  md:rounded-b-2xl overflow-hidden">
                <div class="h-full md:h-[38rem] flex flex-col">
                    <!-- Chat messages -->
                    <div id="chat-messages" class="flex-1 overflow-y-auto px-6 py-5 space-y-4"></div>

                    <!-- Topic selection -->
                    <div id="topic-selection" class="p-4 border-t hidden">
                        <div class="text-sm text-[#101010] opacity-80 mb-4 flex justify-center">Pilih satu minat belajar</div>
                        <div id="topic-buttons" class="flex flex-wrap gap-2 justify-center"></div>
                    </div>

                    <!-- Question selection -->
                    <div id="question-count-selection" class="p-4 border-t hidden">
                        <div class="flex flex-wrap justify-center gap-2">
                            <button onclick="selectQuestionCount(5)"
                                class="px-4 py-2 bg-blue-100 hover:bg-blue-200 rounded-full text-blue-800">5
                                Pertanyaan</button>
                            <button onclick="selectQuestionCount(10)"
                                class="px-4 py-2 bg-blue-100 hover:bg-blue-200 rounded-full text-blue-800">10
                                Pertanyaan</button>
                            <button onclick="selectQuestionCount(15)"
                                class="px-4 py-2 bg-blue-100 hover:bg-blue-200 rounded-full text-blue-800">15
                                Pertanyaan</button>
                        </div>
                    </div>

                    <!-- Quiz section -->
                    <div id="quiz-section" class="p-4 border-t hidden">
                        <div id="question-counter" class="text-sm text-[#696eff] mb-2"></div>
                        <div id="question-text" class="text-lg mb-4"></div>
                        <div id="answer-options" class="space-y-2"></div>
                    </div>

                    <!-- Course recommendation -->
                    <div id="course-recommendation" class="p-4 border-t hidden">
                        <div class="bg-white rounded-lg overflow-hidden">
                            <div class="p-4">
                                <div class="flex items-start gap-4">
                                    <img id="course-image" src="" alt="Course thumbnail"
                                        class="w-24 h-24 object-cover rounded" />
                                    <div class="flex-1">
                                        <h3 id="course-title" class="font-bold text-lg"></h3>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-yellow-500">★</span>
                                            <span id="course-rating"></span>
                                            <span id="course-level"
                                                class="px-2 py-1 bg-blue-100 text-[#052742] text-xs rounded-full"></span>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{('/kursus')}}"> <button
                                    id="course-button"
                                        class="w-full mt-4 px-4 py-2 bg-[#696eff] text-white rounded-lg hover:bg-blue-700">
                                        Lebih Banyak
                                    </button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="footer-section ">
        <div class="footer-container">
            <div class="footer-content">
                <p class="website-name">Luminus</p>
                <p class="footer-text">Tempat kursus koding terbaik untuk bantu kamu jadi ahli di dunia koding!</p>
            </div>
            <div class="footer-content">
                <p class="website-name">Navigasi</p>
                <div class="footer-links">
                    <a href="{{ route('home') }}">
                        <p>Beranda</p>
                    </a>
                    <a href="#about-section">
                        <p>Tentang</p>
                    </a>
                    <a href="#kursus-section">
                        <p>Kursus</p>
                    </a>
                    <a href="#rutekarir-section">
                        <p>Rute Karir</p>
                    </a>
                    <a href="#faq-section">
                        <p>FAQ</p>
                    </a>
                </div>
            </div>
            <div class="footer-content">
                <p class="website-name">Halaman</p>
                <div class="footer-links">
                    <a href="{{ route('home') }}">
                        <p>Beranda</p>
                    </a>
                    <a href="{{ route('courses.list') }}">
                        <p>Kursus</p>
                    </a>
                    <a href="{{ route('forums.index') }}">
                        <p>Forum</p>
                    </a>
                </div>
            </div>
            <div class="footer-content">
                <p class="website-name">Kontak</p>
                <div class="footer-links">
                    <a href="mailto:halo@mediaku.idn">
                        <p>info@luminus.id</p>
                    </a>
                    <p>+62 813 4482 9209</p>
                    <p>Jln. Gajah Mada, Bandung</p>
                </div>
            </div>
        </div>
        <p class="copyright"
            style="position:absolute;bottom:20px;left: 0;width: 100%;text-align: center;opacity: 0.6;color: white;font-weight: 500;font-size: 14px;">
            Copyright © <span>Luminus</span> | Developed by <span>Maba Kabupaten.</span></p>
    </section>

    <style>
        .footer-section {
            height: 45vh;
            background-color: #032038;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footer-container {
            width: 70%;
            height: 100%;
            display: flex;
            justify-content: center;
            /* align-items: center; */
            padding-bottom: 2em;
        }

        .footer-content {
            flex: 1;
            display: flex;
            justify-content: flex-start;
            padding-top: 3em;
            align-items: flex-start;
            flex-direction: column;
        }

        .footer-content:nth-child(2) {
            padding-left: 8em;
        }

        .website-name {
            font-size: 18px;
            font-weight: 600;
            color: white;
        }

        .footer-text {
            margin-top: 1em;
            font-size: 15px;
            font-weight: 400;
            color: white;
            opacity: .6;
        }

        .subs-field {
            margin-top: 1.5em;
            width: 100%;
            height: 35px;
            background-color: var(--blue);
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            /* border: 1px solid white; */
        }

        .subs-field input {
            width: 80%;
            height: 100%;
            border: none;
            padding-left: 1em;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
            background-color: var(--white);
            transition: .2s ease;
            color: white;
        }

        .subs-field input:focus {
            border: none !important;
            outline: none !important;
            background-color: #d9d9d9;
        }

        .subs-field input::placeholder {
            color: #303030;
        }

        .subs-btn {
            width: 20%;
            height: 100%;
            background-color: var(--blue);
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footer-section i {
            color: white;
            font-size: 24px;
        }

        .subs-btn:hover {
            cursor: pointer;
        }

        .subs-btn i {
            transition: .2s ease;
        }

        .subs-btn:hover i {
            transform: translateX(.2em);
        }

        .footer-links {
            margin-top: 1em;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            gap: .5em;
        }

        .footer-links p {
            font-size: 15px;
            font-weight: 400;
            color: white;
            opacity: .6;
        }

        .footer-links p:hover {
            cursor: pointer;
            opacity: 1;
            text-decoration: underline;
        }

        .footer-section span:hover {
            font-weight: 600;
            text-decoration: underline;
            cursor: pointer;
        }

        .footer-section span {
            color: white;
        }

        @media (max-width:1170px) {
            .footer-container {
                width: 90%;
            }
        }

        @media (max-width:900px) {
            .footer-container {
                width: 80%;
                flex-direction: column;
                padding-bottom: 2em;
            }

            .footer-section {
                height: 100% !important;
                padding: 2em 0;
            }

            .footer-content:nth-child(2) {
                padding-left: 0em;
            }

            .subs-field {
                width: 300px;
            }

            .card-section-komunitas {
                border: 1px solid black;
                display: none;
            }

            .card-section-komunitas-tablet {
                width: 100% !important;
                height: 100% !important;
                pad
            }

            .card-komunitas {
                aspect-ratio: 6/5 !important;
            }
        }

        @media (max-width:400px) {
            .footer-container {
                padding-bottom: 4em;
            }

            .copyright {
                padding: 0em 1em;
            }

            .subs-field {
                width: 100%;
            }
        }
    </style>

    <script>
        // Constants and configurations
        const CONSTANTS = {
            DELAY: 1000,
            STORAGE_KEY: 'courseRecommenderState',
            SCORE_THRESHOLDS: {
                ADVANCED: 80,
                INTERMEDIATE: 50
            }
        };

        const topics = [{
            id: 'android',
            label: 'Android',
            icon: '📱'
        }, {
            id: 'frontend',
            label: 'Front-end',
            icon: '🖥️'
        }, {
            id: 'backend',
            label: 'Back-end',
            icon: '🖧'
        }, {
            id: 'cybersecurity',
            label: 'Cybersecurity',
            icon: '🔒'
        }];

        let currentTopic = '';
        let currentQuestion = 0;
        let totalQuestions = 5;
        let score = 0;

        const chatMessages = document.getElementById('chat-messages');
        const topicSelection = document.getElementById('topic-selection');
        const questionCountSelection = document.getElementById('question-count-selection');
        const quizSection = document.getElementById('quiz-section');
        const courseRecommendation = document.getElementById('course-recommendation');

        function addMessage(content, isBot = true) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `flex ${isBot ? 'justify-start' : 'justify-end'}`;

            const previousMessage = chatMessages.lastElementChild;
            const isConsecutiveBot = previousMessage && previousMessage.classList.contains('bot-message') && isBot;

            if (isBot) {
                messageDiv.classList.add('bot-message');
            }

            messageDiv.innerHTML = `
							<div class="flex items-end  w-full ${isBot ? 'space-x-2' : 'space-x-reverse space-x-2 flex-row-reverse'}">
									<div class="max-w-[60%] rounded-lg p-3 ${
											isBot ? 'bg-[#696EFF] text-white rounded-bl-none' : 'bg-gray-100 text-gray-800 rounded-br-none'
									}">
											${content}
									</div>
							</div>
					`;

            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function handleTopicSelect(topicId) {
            currentTopic = topicId;
            const topic = topics.find(t => t.id === topicId);
            addMessage(`${topic.icon} ${topic.label}`, false);
            topicSelection.style.display = 'none';

            setTimeout(() => {
                addMessage('Bagus! Berapa banyak pertanyaan yang ingin kamu jawab?');
                questionCountSelection.style.display = 'block';
            }, CONSTANTS.DELAY);
        }

        function selectQuestionCount(count) {
            totalQuestions = count;
            questionCountSelection.style.display = 'none';
            addMessage(`${count} questions`, false);

            setTimeout(() => {
                addMessage(`Sempurna! Mari kita mulai dengan ${count} pertanyaan.`);
                startQuiz();
            }, CONSTANTS.DELAY);
        }

        function startQuiz() {
            currentQuestion = 0;
            score = 0;
            showQuestion();
        }

        function showQuestion() {
            if (currentQuestion < totalQuestions) {
                const question = window.questions[currentTopic][currentQuestion % window.questions[currentTopic].length];
                quizSection.style.display = 'block';

                document.getElementById('question-counter').textContent =
                    `Question ${currentQuestion + 1}/${totalQuestions}`;
                document.getElementById('question-text').textContent = question.question;

                const optionsHtml = question.options.map(option => `
									<button 
											onclick="selectAnswer('${option.value}')"
											class="w-full text-left px-4 py-3 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors"
									>
											${option.label}
									</button>
							`).join('');

                document.getElementById('answer-options').innerHTML = optionsHtml;
            } else {
                showRecommendation();
            }
        }

        function selectAnswer(answer) {
            const question = window.questions[currentTopic][currentQuestion % window.questions[currentTopic].length];
            addMessage(question.options.find(opt => opt.value === answer).label, false);

            if (answer === question.correct) {
                score++;
            }

            currentQuestion++;
            quizSection.style.display = 'none';

            if (currentQuestion < totalQuestions) {
                setTimeout(showQuestion, CONSTANTS.DELAY);
            } else {
                setTimeout(showRecommendation, CONSTANTS.DELAY);
            }
        }

        function showRecommendation() {
            const percentage = (score / totalQuestions) * 100;
            let level, course;

            if (percentage >= CONSTANTS.SCORE_THRESHOLDS.ADVANCED) {
                level = "Advanced";
                course = {
                    title: `${currentTopic.charAt(0).toUpperCase() + currentTopic.slice(1)} Expert Course`,
                    rating: "4.9"
                };
            } else if (percentage >= CONSTANTS.SCORE_THRESHOLDS.INTERMEDIATE) {
                level = "Intermediate";
                course = {
                    title: `Intermediate ${currentTopic.charAt(0).toUpperCase() + currentTopic.slice(1)}`,
                    rating: "4.7"
                };
            } else {
                level = "Beginner";
                course = {
                    title: `${currentTopic.charAt(0).toUpperCase() + currentTopic.slice(1)} Fundamentals`,
                    rating: "4.5"
                };
            }

            addMessage(`Based on your responses, you are at a ${level} level. Here's a recommended course:`);

            document.getElementById('course-title').textContent = course.title;
            document.getElementById('course-rating').textContent = course.rating;
            document.getElementById('course-level').textContent = level;
            document.getElementById('course-image').src =
                `{{ asset('images/${currentTopic}.jpg') }}`;

            courseRecommendation.style.display = 'block';
        }

        function init() {
            addMessage('Halo! Saya akan membantu kamu menemukan kelas yang tepat berdasarkan minat belajar kamu.');
            setTimeout(() => {
                addMessage('Topik apa yang ingin kamu kuasai?');
                showTopicSelection();
            }, CONSTANTS.DELAY);
        }

        function showTopicSelection() {
            topicSelection.style.display = 'block';
            const topicButtons = document.getElementById('topic-buttons');
            topicButtons.innerHTML = topics.map(topic => `
							<button 
									onclick="handleTopicSelect('${topic.id}')"
									class="flex items-center gap-2 rounded-full px-4 py-2 bg-blue-50 hover:bg-blue-100 transition-colors text-[#101010]"
							>
									<span>${topic.icon}</span> ${topic.label}
							</button>
					`).join('');
        }

        function resetChat() {
            localStorage.removeItem(CONSTANTS.STORAGE_KEY);
            chatMessages.innerHTML = '';
            topicSelection.style.display = 'none';
            questionCountSelection.style.display = 'none';
            quizSection.style.display = 'none';
            courseRecommendation.style.display = 'none';
            init();
        }

        // Initialize
        window.addEventListener('load', init);
    </script>
</body>

</html>



