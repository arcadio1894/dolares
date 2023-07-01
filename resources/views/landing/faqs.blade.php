@extends('layouts.landing')

@section('title', '')

@section('activeNavFaqs', 'active')

@section('content')
    <!--begin::Layout-->
    <div class="d-flex flex-column flex-lg-row">
        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto w-100 w-lg-275px mb-10 me-lg-20">
            
            
            <!--end::Search blog-->
            <!--begin::Recent posts-->
            <div class="m-0">
                <h4 class="text-black mb-7">Promociones</h4>
                <!--begin::Item-->
                <div class="d-flex flex-stack mb-7">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-60px symbol-2by3 me-4">
                        <div class="symbol-label" style="background-image: url('assets/media/stock/600x400/img-1.jpg')"></div>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Title-->
                    <div class="m-0">
                        <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Sorteo diario 100 Soles</a>
                        <span class="text-gray-600 fw-bold d-block pt-1 fs-7">Si recargaste más de 20$, ya estas participando.</span>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="d-flex flex-stack mb-7">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-60px symbol-2by3 me-4">
                        <div class="symbol-label" style="background-image: url('assets/media/stock/600x400/img-2.jpg')"></div>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Title-->
                    <div class="m-0">
                        <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Cupon SOYDOLARERO</a>
                        <span class="text-gray-600 fw-bold d-block pt-1 fs-7">Mejora tu tipo de cambio si es tu pimer cambio.</span>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                
                <!--end::Item-->
            </div>
            <!--end::Recent posts-->
        </div>
        <!--end::Sidebar-->
        <!--begin::Content-->
        <div class="flex-lg-row-fluid">
            <!--begin::Extended content-->
            <div class="mb-13">
                <!--begin::Content-->
                <div class="mb-15">
                    <!--begin::Title-->
                    <h4 class="fs-2x text-gray-800 w-bolder mb-6">Más informacion sobre Dolareros.com</h4>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <p class="fw-bold fs-4 text-gray-600 mb-2">Resolvemos las dudas más importantes que tengas con estos tópicos, despliegalos para informarte. En caso aún tengas alguna otra duda puedes comunicarte con nosotros Aqui!.</p>
                    <!--end::Text-->
                </div>
                <!--end::Content-->
                <!--begin::Item-->
                <div class="mb-15">
                    <!--begin::Title-->
                    <h3 class="text-gray-800 w-bolder mb-4">Preguntas frecuentes</h3>
                    <!--end::Title-->
                    <!--begin::Accordion-->
                    <!--begin::Section-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_8_1">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
																		<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">¿Cómo funciona Dolareros?</h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_8_1" class="collapse fs-6 ms-1">
                            <!--begin::Text-->
                            <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Solo regístrate y/o Ingresa desde la web o tu app, luego: 
                            <br><br>1° Ingresa el monto a cambiar, coloca tu banco de origen y cuenta destino.
                            <br>2° Transfiere a nuestro número de cuenta.
                            <br>3° Valida tu operación colocando el número de operación. 
                            <br><br> También puedes ver nuestro tutorial : AQUI!</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Section-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_8_2">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
																		<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Tiempos de deposito</h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_8_2" class="collapse fs-6 ms-1">
                            <!--begin::Text-->
                            <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Una vez hayas ingresado tu número de operación, nosotros lo validaremos, si los datos de tu deposito coinciden te depositaremos de inmediato. (Tiempo estimado de todo el proceso = 15 min).</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Section-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_8_3">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
																		<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Monto máximo y mínimo</h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_8_3" class="collapse fs-6 ms-1">
                            <!--begin::Text-->
                            <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Dolareros no tiene montos máximos ni mínimos para tu depósito.</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Section-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_8_4">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
																		<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Sin tarifas ni comisiones</h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_8_4" class="collapse fs-6 ms-1">
                            <!--begin::Text-->
                            <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Dolareros no te cobra ninguna tarifa ni comisiones, sin embargo, fíjate en las políticas de tu banco, hay algunos bancos que por montos superiores pueden cobrarte alguna comisión adicional.</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Content-->
                         <!--begin::Separator-->
                         <div class="separator separator-dashed"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Section-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_8_6">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
																		<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">¿Puedo usar Dolareros desde cualquier región del Perú?</h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_8_6" class="collapse fs-6 ms-1">
                            <!--begin::Text-->
                            <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Así es, puedes usar Dolareros desde cualquier parte del Perú y realizar tus cambios de manera rápida y segura.</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Content-->
                         <!--begin::Separator-->
                         <div class="separator separator-dashed"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Section-->
                     <!--begin::Section-->
                     <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_8_5">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
																		<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">¿Es seguro usar Dolareros?</h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_8_5" class="collapse fs-6 ms-1">
                            <!--begin::Text-->
                            <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Claro que si, Somos una empresa formal y estamos registrados en el Registro de Casas de Cambio de la Superintendencia de Banca y Seguros, ademas estamos registrados en la asociacion de Fintech del Perú. Asi mismo cumplimos con todas nuestras obligaciones legales y regulatorias, y reportamos a la SBS, a través de la UIF en materia de Prevención de Lavado de Activos y Financiamiento del Terrorismo.</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Content-->
                       
                    </div>
                    <!--end::Section-->
                    <!--end::Accordion-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="mb-15">
                    <!--begin::Title-->
                    <h3 class="text-gray-800 w-bolder mb-4">Legal</h3>
                    <!--end::Title-->
                    <!--begin::Accordion-->
                    <!--begin::Section-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_9_1">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
																		<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Términos y condiciones</h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_9_1" class="collapse fs-6 ms-1">
                            <!--begin::Text-->
                            <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Infórmate de nuestro TyC aqui!</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Section-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_9_2">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
																		<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Políticas de privacidad</h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_9_2" class="collapse fs-6 ms-1">
                            <!--begin::Text-->
                            <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Conoce nuestra política de privacidad aquí!.</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Section-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_9_3">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
																		<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Libro de reclamaciones</h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_9_3" class="collapse fs-6 ms-1">
                            <!--begin::Text-->
                            <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Este es nuestro libro de reclamaciones, ingresa aqui!.</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Section-->

                    <!--end::Accordion-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="mb-0">
                    <!--begin::Title-->
                    <h3 class="text-gray-800 w-bolder mb-4">Tutoriales</h3>
                    <!--end::Title-->
                    <!--begin::Accordion-->
                    <!--begin::Section-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 collapsed toggle mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_10_1">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
																		<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">¿Cómo me registro?</h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_10_1" class="collapse fs-6 ms-1">
                            <!--begin::Text-->
                            <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Ingresa todos los datos que te solicitamos segun si eres persona o empresa, estos serviran para validar tu identidad y darle mayor seguridad a tu cuenta. Puedes ver el video tutorial AQUI!.</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Section-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_10_2">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
																		<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">Valida tus documentos de identidad</h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_10_2" class="collapse fs-6 ms-1">
                            <!--begin::Text-->
                            <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Sea que te registraste como persona o como empresa, antes de hacer algun cambio es necesario que presentes los documentos pertinentes (Este proceso se hace una única vez). Puedes ver el video tutorial AQUI!</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Section-->
                   
                    <!--begin::Section-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_10_4">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
                                <span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                <span class="svg-icon toggle-off svg-icon-1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
																		<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
																		<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
																	</svg>
																</span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Icon-->
                            <!--begin::Title-->
                            <h4 class="text-gray-700 fw-bolder cursor-pointer mb-0">¿Cómo uso mis cupones especiales?</h4>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div id="kt_job_10_4" class="collapse fs-6 ms-1">
                            <!--begin::Text-->
                            <div class="mb-4 text-gray-600 fw-bold fs-6 ps-10">Los cupones de descuento te ayudaran a mejora aun más la tasa de cambio por una única vez. Para ver como usarlos puedes ver Aqui!.</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Section-->
                    <!--end::Accordion-->
                </div>
                <!--end::Item-->
            </div>
            <!--end::Extended content-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Layout-->
    <!--begin::Card-->
    <div class="card mb-4 bg-light text-center">
        <!--begin::Body-->
        <div class="card-body py-12">
            <!--begin::Icon-->
            <a href="https://www.facebook.com/profile.php?id=100091569067559" class="mx-4" target="_blank">
                <img src="assets/media/svg/brand-logos/facebook-4.svg" class="h-30px my-2" alt="" />
            </a>
            <!--end::Icon-->
            <!--begin::Icon-->
            <a href="https://www.youtube.com/@Dolareros" class="mx-4" target="_blank">
                <img src="assets/media/svg/brand-logos/youtube-play.svg" class="h-30px my-2" alt="" />
            </a>
            <!--end::Icon-->
            <!--begin::Icon-->
            <a href="https://twitter.com/dolareros" class="mx-4" target="_blank">
                <img src="assets/media/svg/brand-logos/twitter.svg" class="h-30px my-2" alt="" />
            </a>
            <!--end::Icon-->
            <!--begin::Icon-->
            <a href="https://www.linkedin.com/company/dolareros" class="mx-4" target="_blank">
                <img src="assets/media/svg/brand-logos/linkedin.png" class="h-30px my-2" alt="" />
            </a>
            <!--end::Icon-->
            <!--begin::Icon-->
            <a href="https://www.instagram.com/dolareros/" class="mx-4" target="_blank">
                <img src="assets/media/svg/brand-logos/instagram-2-1.svg" class="h-30px my-2" alt="" />
            </a>
            <!--end::Icon-->
           
        </div>
        <!--end::Body-->
    </div>
    <!--end::Card-->
@endsection

@section('scripts')
    {{--<script src="{{ asset('assets/js/graph/indexBloomberg.js') }}"></script>--}}
@endsection
