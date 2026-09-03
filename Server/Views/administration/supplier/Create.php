<?php include_once __DIR__.'/../../includes/Header.php'; ?>
<main class="flex lg:flex-row xs:flex-col p-5 pb-22">
    <header class="flex flex-col">
        <span class="text-cyan-300">Alta de proveedor</span>
        <h1 class="font-semibold text-4xl">Formulario para nuevo registro</h1>
        <p class="text-tsecondary mt-2">Completa el siguiente formulario para registrar un nuevo proveedor.</p>
    </header>
    <section class="flex flex-col mt-6 gap-4">
        <a href="/administracion/proveedores" class="flex items-center gap-2 w-fit p-2 px-4 rounded-lg bg-bprincipal-light">
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
        <form action="/suppliers" method="POST" class="flex flex-col gap-4">
            <div class="flex flex-col gap-4 border-2 border-dashed border-cyan-700 rounded-lg p-5">
                <div class="flex flex-row items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                    </svg>
                    <h3 class="font-medium text-tprincipal">Información del proveedor</h3>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="name" class="text-tsecondary text-sm">Nombre</label>
                    <input type="text" name="name" id="name" placeholder="Fruticultor" class="bg-bprincipal-light rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-cyan-300 transition-all">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="business_name" class="text-tsecondary text-sm">Razón social del proveedor</label>
                    <input type="text" name="business_name" id="business_name" placeholder="Casa de las frutas" class="bg-bprincipal-light rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-cyan-300 transition-all">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="address" class="text-tsecondary text-sm">Dirección</label>
                    <input type="text" name="address" id="address" placeholder="calle lapiz lazuli #125 col. centro" class="bg-bprincipal-light rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-cyan-300 transition-all">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="method_payment_id" class="text-tsecondary text-sm">Metodo de pago</label>
                    <select name="method_payment_id" id="method_payment_id" class="bg-bprincipal-light rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-cyan-300 transition-all">
                        <option value="">Selecciona un método</option>
                        <?php foreach ($payment_methods as $method): ?>
                            <option value="<?= $method->id ?>"><?= $method->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="category_supplier_id" class="text-tsecondary text-sm">Giro comercial</label>
                    <select name="category_supplier_id" id="category_supplier_id" class="bg-bprincipal-light rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-cyan-300 transition-all">
                        <option value="">Selecciona una categoria</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->id ?>"><?= $category->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="flex flex-row justify-end">
                        <a class="text-sm text-cyan-300 hover:text-cyan-400 text-end" href="/administracion/proveedores/categorias/crear">Nuevo giro</a>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-4 border-2 border-dashed border-cyan-700 rounded-lg p-5">
                <div class="flex flex-row items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                    </svg>
                    <h3 class="font-medium text-tprincipal">Información de contacto</h3>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="name_contact" class="text-tsecondary text-sm">Nombre completo</label>
                    <input type="text" name="name_contact" id="name_contact" placeholder="Alejandra Rodriguez" class="bg-bprincipal-light rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-cyan-300 transition-all">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="email" class="text-tsecondary text-sm">Correo electronico</label>
                    <input type="email" name="email" id="email" placeholder="alejandra@proveedor.com" class="bg-bprincipal-light rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-cyan-300 transition-all">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="phone_number" class="text-tsecondary text-sm">Número de teléfono</label>
                    <input type="text" name="phone_number" id="phone_number" placeholder="871 123 4567" class="bg-bprincipal-light rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-cyan-300 transition-all">
                </div>
            </div>
            <div class="flex flex-col gap-4 border-2 border-dashed border-cyan-700 rounded-lg p-5">
                <div class="flex flex-row items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                        <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
                    </svg>
                    <h3 class="font-medium text-tprincipal">Programa de atención</h3>
                </div>
                <div class="flex flex-col gap-2">
                    <span class="text-tsecondary text-sm">Días de pedido</span>

                    <div class="flex justify-between items-center bg-bprincipal-light p-2 px-4 rounded-lg">
                        <div class="flex flex-col items-center justify-center gap-1">
                            <label for="lunes">L</label>
                            <input name="pedido[]" id="lunes" type="checkbox" value="LUNES" />
                        </div>

                        <div class="flex flex-col items-center justify-center gap-1">
                            <label for="martes">M</label>
                            <input name="pedido[]" id="martes" type="checkbox" value="MARTES" />
                        </div>

                        <div class="flex flex-col items-center justify-center gap-1">
                            <label for="miercoles">X</label>
                            <input name="pedido[]" id="miercoles" type="checkbox" value="MIERCOLES" />
                        </div>

                        <div class="flex flex-col items-center justify-center gap-1">
                            <label for="jueves">J</label>
                            <input name="pedido[]" id="jueves" type="checkbox" value="JUEVES" />
                        </div>

                        <div class="flex flex-col items-center justify-center gap-1">
                            <label for="viernes">V</label>
                            <input name="pedido[]" id="viernes" type="checkbox" value="VIERNES" />
                        </div>

                        <div class="flex flex-col items-center justify-center gap-1">
                            <label for="sabado">S</label>
                            <input name="pedido[]" id="sabado" type="checkbox" value="SABADO" />
                        </div>

                        <div class="flex flex-col items-center justify-center gap-1">
                            <label for="domingo">D</label>
                            <input name="pedido[]" id="domingo" type="checkbox" value="DOMINGO" />
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <span class="text-tsecondary text-sm">Días de entrega</span>

                    <div class="flex justify-between items-center bg-bprincipal-light p-2 px-4 rounded-lg">
                        <div class="flex flex-col items-center justify-center gap-1">
                            <label for="lunesE">L</label>
                            <input name="entrega[]" id="lunesE" type="checkbox" value="LUNES" />
                        </div>

                        <div class="flex flex-col items-center justify-center gap-1">
                            <label for="martesE">M</label>
                            <input name="entrega[]" id="martesE" type="checkbox" value="MARTES" />
                        </div>

                        <div class="flex flex-col items-center justify-center gap-1">
                            <label for="miercolesE">X</label>
                            <input name="entrega[]" id="miercolesE" type="checkbox" value="MIERCOLES" />
                        </div>

                        <div class="flex flex-col items-center justify-center gap-1">
                            <label for="juevesE">J</label>
                            <input name="entrega[]" id="juevesE" type="checkbox" value="JUEVES" />
                        </div>

                        <div class="flex flex-col items-center justify-center gap-1">
                            <label for="viernesE">V</label>
                            <input name="entrega[]" id="viernesE" type="checkbox" value="VIERNES" />
                        </div>

                        <div class="flex flex-col items-center justify-center gap-1">
                            <label for="sabadoE">S</label>
                            <input name="entrega[]" id="sabadoE" type="checkbox" value="SABADO" />
                        </div>

                        <div class="flex flex-col items-center justify-center gap-1">
                            <label for="domingoE">D</label>
                            <input id="entrega[]" type="checkbox" value="DOMINGO" />
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="bg-cyan-300 rounded-lg text-tprincipal-invert p-3 hover:bg-bsecundario/80 transition-all font-semibold">Guardar cambios</button>
        </form>
    </section>
</main>
<?php include_once __DIR__.'/../../includes/Footer.php'; ?>