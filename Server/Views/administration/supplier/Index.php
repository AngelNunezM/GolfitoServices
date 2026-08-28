<?php include_once __DIR__.'/../../includes/Header.php'; ?>
<main class="flex lg:flex-row xs:flex-col p-5">
    <header class="flex flex-col">
        <span class="text-cyan-300">Proveedores</span>
        <h1 class="font-semibold text-4xl">Lista de proveedores</h1>
        <p class="text-tsecondary mt-2">Gestiona la lista de proveedores de tu negocio.</p>
    </header>
    <section class="flex flex-col mt-6 gap-4">
        <div class="flex gap-2 items-center justify-between">
            <div class="flex items-center w-full">
                <input type="text" placeholder="Buscar proveedor..." class="bg-bprincipal-light rounded-l-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-cyan-300 transition-all">
                <button class="bg-cyan-300 rounded-r-lg text-tprincipal-invert p-3 hover:bg-bsecundario/80 transition-all" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <a href="/administracion/proveedores/crear" class="flex flex-row items-center gap-2 bg-bprincipal-light rounded-lg p-3 hover:bg-bsecundario/80 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                </svg>
            </a>
        </div>

        <?php if (!empty($error ?? '')): ?>
            <div class="rounded-lg border border-red-500 bg-red-500/10 p-3 text-sm text-red-200">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <div class="overflow-hidden rounded-xl border border-gray-700 bg-bprincipal shadow-sm">
            <table class="min-w-full">
                <thead class="bg-bprincipal-light">
                    <tr>
                        <th class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-300">#</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-300">Nombre del proveedor</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-300">Estado</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-300">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <?php if (!empty($suppliers)): ?>
                        <?php foreach ($suppliers as $index => $supplier): ?>
                            <tr class="transition-colors hover:bg-gray-50/5">
                                <td class="px-3 py-4 text-sm font-medium text-gray-400"><?= $index + 1 ?></td>
                                <td class="px-3 py-4 text-sm text-gray-400"><?= htmlspecialchars($supplier->name ?? '') ?></td>
                                <td class="px-3 py-4 text-sm text-gray-400">
                                    <span class="rounded-full px-2 py-1 text-xs <?= ($supplier->is_active ?? true) ? 'bg-emerald-500/20 text-emerald-300' : 'bg-red-500/20 text-red-300' ?>">
                                        <?= ($supplier->is_active ?? true) ? 'Activo' : 'Inactivo' ?>
                                    </span>
                                </td>
                                <td class="px-3 py-4 text-sm text-gray-300">
                                    <div class="flex gap-2">
                                        <a href="/administracion/proveedores/<?= htmlspecialchars((string) ($supplier->id ?? '')) ?>/editar" class="rounded bg-cyan-500/20 px-2 py-1 text-xs text-cyan-200 hover:bg-cyan-500/30">Editar</a>
                                        <form method="POST" action="/administracion/proveedores/<?= htmlspecialchars((string) ($supplier->id ?? '')) ?>/eliminar" onsubmit="return confirm('¿Deseas cambiar el estado del proveedor?')">
                                            <button type="submit" class="rounded bg-red-500/20 px-2 py-1 text-xs text-red-200 hover:bg-red-500/30">Toggle</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="px-3 py-6 text-center text-sm text-gray-400">No hay proveedores registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
<?php include_once __DIR__.'/../../includes/Footer.php'; ?>