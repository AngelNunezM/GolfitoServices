<?php include_once __DIR__.'/../includes/Header.php'; ?>
    <main class="flex lg:flex-row xs:flex-col p-5">
        <header class="flex flex-col">
            <span class="text-cyan-300">Adminstración</span>
            <h1 class="font-semibold text-4xl">Gestión del negocío</h1>
            <p class="text-tsecondary mt-2">Aquí puedes gestionar todas la información relacionada con tu negocio.</p>
        </header>
        <section class="flex flex-col gap-2 mt-6">
            <a class="flex flex-col bg-bprincipal-light rounded-lg p-5 hover:bg-bsecundario/80 transition-all" href="/administracion/proveedores">
                <h2 class="text-lg font-semibold">Proveedores</h2>
                <p class="text-tsecondary text-sm">Gestiona los proveedores de tu negocio.</p>
            </a>
            <a class="flex flex-col bg-bprincipal-light rounded-lg p-5 hover:bg-bsecundario/80 transition-all" href="/administracion/almacen">
                <h2 class="text-lg font-semibold">Almacén de productos</h2>
                <p class="text-tsecondary text-sm">Gestiona tu almacén de productos.</p>
            </a>
            <a class="flex flex-col bg-bprincipal-light rounded-lg p-5 hover:bg-bsecundario/80 transition-all" href="/administracion/cuentas">
                <h2 class="text-lg font-semibold">Cuentas de usuario</h2>
                <p class="text-tsecondary text-sm">Gestiona la información de tus usuarios.</p>
            </a>
        </section>
    </main>
<?php include_once __DIR__.'/../includes/Footer.php'; ?>
