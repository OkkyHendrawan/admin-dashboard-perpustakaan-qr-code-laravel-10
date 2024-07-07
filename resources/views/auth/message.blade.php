@if(session('success'))
    <div id="alertSuccess" class="bg-green-500 dark:bg-green-700 border-l-4 border-green-700 dark:border-green-900 text-white px-4 py-3 rounded relative transition-opacity duration-500 ease-out" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="document.getElementById('alertSuccess').style.display = 'none';">
            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-6 w-6 text-white" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-11.293a1 1 0 00-1.414 0L10 9.586 7.707 7.293a1 1 0 00-1.414 1.414l2.293 2.293-2.293 2.293a1 1 0 001.414 1.414L10 12.414l2.293 2.293a1 1 0 001.414-1.414l-2.293-2.293 2.293-2.293a1 1 0 000-1.414z" clip-rule="evenodd"/>
            </svg>
        </button>
    </div>

    <script>
        setTimeout(function() {
            document.getElementById('alertSuccess').classList.add('opacity-0');
            setTimeout(function() {
                document.getElementById('alertSuccess').style.display = 'none';
            }, 500); // transition duration to match the class duration
        }, 5000); // 5000 milliseconds = 5 seconds, adjust as needed
    </script>
@endif

@if(session('error'))
    <div id="alertError" class="bg-red-500 dark:bg-red-700 border-l-4 border-red-700 dark:border-red-900 text-white px-4 py-3 rounded relative transition-opacity duration-500 ease-out" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="document.getElementById('alertError').style.display = 'none';">
            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-6 w-6 text-white" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-11.293a1 1 0 00-1.414 0L10 9.586 7.707 7.293a1 1 0 00-1.414 1.414l2.293 2.293-2.293 2.293a1 1 0 001.414 1.414L10 12.414l2.293 2.293a1 1 0 001.414-1.414l-2.293-2.293 2.293-2.293a1 1 0 000-1.414z" clip-rule="evenodd"/>
            </svg>
        </button>
    </div>

    <script>
        setTimeout(function() {
            document.getElementById('alertError').classList.add('opacity-0');
            setTimeout(function() {
                document.getElementById('alertError').style.display = 'none';
            }, 500); // transition duration to match the class duration
        }, 5000); // 5000 milliseconds = 5 seconds, adjust as needed
    </script>
@endif
