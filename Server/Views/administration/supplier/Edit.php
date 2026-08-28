<?php include_once __DIR__.'/../../includes/Header.php'; ?>
<main class="flex lg:flex-row xs:flex-col p-5 pb-22">
    <header class="flex flex-col">
        <span class="text-cyan-300">Edición de proveedor</span>
        <h1 class="font-semibold text-4xl">Actualizar información</h1>
        <p class="text-tsecondary mt-2">Actualiza los datos del proveedor seleccionado.</p>
    </header>
    <section class="flex flex-col mt-6 gap-4">
        <button onclick="history.back()" class="flex items-center gap-2 w-fit p-2 px-4 rounded-lg bg-bprincipal-light">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
            </svg>
            <span>Volver atrás</span>
        </button>

        <?php if (!empty($error ?? '')): ?>
            <div class="rounded-lg border border-red-500 bg-red-500/10 p-3 text-sm text-red-200">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/administracion/proveedores/<?= htmlspecialchars($supplier->id ?? '') ?>/actualizar" class="flex flex-col gap-4 border-2 border-dashed border-cyan-700 rounded-lg p-5">
            <div class="flex flex-col gap-2">
                <label for="name" class="text-tsecondary text-sm">Nombre del proveedor</label>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($supplier->name ?? '') ?>" class="bg-bprincipal-light rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-cyan-300 transition-all">
            </div>
            <div class="flex flex-col gap-2">
                <label for="business_name" class="text-tsecondary text-sm">Razón social</label>
                <input type="text" name="business_name" id="business_name" value="<?= htmlspecialchars($supplier->business_name ?? '') ?>" class="bg-bprincipal-light rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-cyan-300 transition-all">
            </div>
            <div class="flex flex-col gap-2">
                <label for="address" class="text-tsecondary text-sm">Dirección</label>
                <input type="text" name="address" id="address" value="<?= htmlspecialchars($supplier->address ?? '') ?>" class="bg-bprincipal-light rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-cyan-300 transition-all">
            </div>
            <button type="submit" class="bg-cyan-300 rounded-lg text-tprincipal-invert p-3 hover:bg-bsecundario/80 transition-all font-semibold mt-2">Actualizar proveedor</button>
        </form>
    </section>
</main>
<?php include_once __DIR__.'/../../includes/Footer.php'; ?>
