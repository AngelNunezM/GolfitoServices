<?php include_once __DIR__.'/includes/Header.php'; ?>
    <main class="flex lg:flex-row xs:flex-col p-5">
        <header class="flex flex-col">
            <span class="text-cyan-300">Hola, </span>
            <h1 class="font-semibold text-4xl"><?= $userSession->name ?>.</h1>
            <p class="text-tsecondary mt-2">Bienvenido a tu panel de control, los datos están actualizados al mes vigente.</p>
        </header>
        <section class="flex flex-col">

        </section>
    </main>
<?php include_once __DIR__.'/includes/Footer.php'; ?>
