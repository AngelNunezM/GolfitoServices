<?php include_once __DIR__.'/../../../includes/Header.php'; ?>
<main class="flex lg:flex-row xs:flex-col p-5 pb-22">
    <header class="flex flex-col">
        <span class="text-cyan-300">Alta de giro comercial</span>
        <h1 class="font-semibold text-4xl">Formulario para nuevo registro</h1>
        <p class="text-tsecondary mt-2">Completa el siguiente formulario para registrar un nuevo giro comercial.</p>
    </header>
    <section class="flex flex-col mt-6 gap-4">
        <a href="/administracion/proveedores/crear" class="flex items-center gap-2 w-fit p-2 px-4 rounded-lg bg-bprincipal-light">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
            </svg>
            <span>Volver atras</span>
        </a>
        <?php if (!empty($error ?? '')): ?>
            <div class="rounded-lg border border-red-500 bg-red-500/10 p-3 text-sm text-red-200">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form action="/category-suppliers" method="POST" class="flex flex-col gap-4">
            <div class="flex flex-col gap-4 border-2 border-dashed border-cyan-700 rounded-lg p-5">
                <div class="flex flex-row items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                    </svg>
                    <h3 class="font-medium text-tprincipal">Detalles del giro comercial</h3>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="name" class="text-tsecondary text-sm">Nombre</label>
                    <input type="text" name="name" id="name" placeholder="Fruteras y verduras" class="bg-bprincipal-light rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-cyan-300 transition-all">
                </div>
            </div>
            <button type="submit" class="bg-cyan-300 rounded-lg text-tprincipal-invert p-3 hover:bg-bsecundario/80 transition-all font-semibold">Guardar cambios</button>
        </form>
    </section>
</main>
<?php include_once __DIR__.'/../../../includes/Footer.php'; ?>