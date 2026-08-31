<?php include_once __DIR__.'/../includes/Header.php'; ?>
    <main class="flex flex-col h-screen w-full overflow-hidden justify-center items-center">
        <figure class="fixed top-2 left-0">
            <img src="./assets/icons/icon.png" alt="Logo de El Golfito" class="w-24 invert">
        </figure>
        <div class=" flex justify-center items-center xs:w-11/12 sm:w-7/12 lg:w-4/12">
            <form method="POST" action="/login" class="flex flex-col gap-6 w-full">
                <div class="flex flex-col gap-2">      
                    <h1 class="text-tprincipal font-semibold text-4xl">Inicia sesión con tus credenciales </h1>
                    <span class="text-tsecondary">Gestiona todas tus actividades dentro del restaurante "<a href="https://Elgolfito.mx/" target="_blank" class="font-medium text-tprincipal/70">El Golfito</a>".</span>
                </div>
                <?php if (!empty($error ?? '')): ?>
                    <div class="rounded-lg border border-red-500 bg-red-500/10 p-3 text-sm text-red-200">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-2">
                        <label for="username" class="text-tsecondary text-sm">Usuario</label>
                        <input type="text" name="username" id="username" placeholder="vfarrera2002" class="bg-bprincipal-light rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-cyan-300 transition-all">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="password" class="text-tsecondary text-sm">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="********" class="bg-bprincipal-light rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-cyan-300 transition-all">
                    </div>
                    <div class="mt-2 w-full flex">
                        <button type="submit" class="bg-bprincipal-invert cursor-pointer p-3 rounded-full text-tprincipal-invert font-semibold hover:bg-bprincipal-invert-light hover:scale-102 transition-all ease-linear w-full">Iniciar sesión</button>
                    </div>
                </div>
            </form>
        </div>
            
        <div class="fixed bottom-2 w-full flex justify-center">
            <span class="text-[#8b8b8b] text-xs text-nowrap">Todos los derechos reservados @El Golfito 1975</span>
        </div>
    </main>
<?php include_once __DIR__.'/../includes/Footer.php'; ?>
