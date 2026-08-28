        <?php if (!empty($error)): ?>
            <div id="alert-message" class="fixed right-2 top-4 flex justify-center">
                <p class="p-3 text-xs text-red-300 bg-red-950 backdrop-blur-md rounded-xl w-fit font-medium flex items-start gap-1">
                    <button id="close-alert" class="text-white hover:text-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <?= htmlspecialchars($error) ?>
                </p>
            </div>
        <?php endif; ?>
        <?php include_once __DIR__.'/Aside.php'; ?>
        <script type="module" src="<?= $urlAbsolute ?>/js/main.js"></script>
    </body>
</html>
