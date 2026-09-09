<script setup>
import { ref } from "vue";
import { Eye, Pencil, Trash } from "lucide-vue-next";
import PersonaForm from "@/components/Personas/PersonaForm.vue";

defineProps({
    personas: Array,
});

const mostrarModal = ref(false);
const personaSeleccionada = ref(null);
const mostrarFormulario = ref(false);

function verPersona(persona) {
    personaSeleccionada.value = persona;
    mostrarModal.value = true;
}
</script>

<template>
    <div class="p-6">
        <!-- Encabezado -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold">Personas</h1>

                <p class="mt-1 text-sm text-gray-500">
                    Módulo de gestión de personas - RRHH AJ
                </p>
            </div>

            <button
                type="button"
                class="rounded-md bg-black px-4 py-2 text-sm font-medium text-white hover:bg-gray-500"
                @click="mostrarFormulario = true"
            >
                Nueva persona
            </button>

            <!-- COMPONENTE MOSTRAR FORMULARIO -->
            <PersonaForm
                :mostrar="mostrarFormulario"
                @cerrar="mostrarFormulario = false"
            />

        </div>

        <!-- Tabla -->
        <div class="overflow-hidden rounded-lg border bg-white">
            <table class="w-full text-left text-sm text-black">
                <thead class="border-b bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 font-medium">CI</th>

                        <th class="px-6 py-3 font-medium">Nombre completo</th>

                        <th class="px-6 py-3 font-medium">Género</th>

                        <th class="px-6 py-3 font-medium">
                            Fecha de nacimiento
                        </th>

                        <th class="px-6 py-3 font-medium">Estado civil</th>

                        <th class="px-6 py-3 font-medium">Estado</th>

                        <th class="px-6 py-3 font-medium">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    <tr
                        v-for="persona in personas"
                        :key="persona.id_persona"
                        class="hover:bg-gray-50"
                    >
                        <td class="px-6 py-4">
                            {{ persona.carnet }}
                        </td>

                        <td class="px-6 py-4 font-medium">
                            {{ persona.nombres }}
                            {{ persona.apellido_paterno }}
                            {{ persona.apellido_materno }}
                            {{ persona.apellido_casado }}
                        </td>

                        <td class="px-6 py-4">
                            {{ persona.genero ?? "—" }}
                        </td>

                        <td class="px-6 py-4">
                            {{ persona.fecha_nacimiento ?? "—" }}
                        </td>

                        <td class="px-6 py-4">
                            {{ persona.estado_civil ?? "—" }}
                        </td>

                        <td class="px-6 py-4">
                            <span
                                v-if="persona.estado === 1"
                                class="rounded-full px-2.5 py-1 text-xs font-medium bg-green-100 text-green-800"
                            >
                                Activo
                            </span>

                            <span
                                v-else
                                class="rounded-full px-2.5 py-1 text-xs font-medium"
                            >
                                Inactivo
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <button
                                type="button"
                                class="mr-2 rounded-full bg-blue-300 p-2 text-black hover:bg-blue-400"
                                tittle="Ver persona"
                                @click="verPersona(persona)"
                            >
                                <Eye class="h-4 w-4" />
                            </button>

                            <button
                                type="button"
                                class="mr-2 rounded-full bg-yellow-200 p-2 text-black hover:bg-yellow-300"
                                tittle="Editar persona"
                            >
                                <Pencil class="h-4 w-4" />
                            </button>

                            <button
                                type="button"
                                class="mr-2 rounded-full bg-red-300 p-2 text-black hover:bg-red-400"
                                tittle="Editar persona"
                            >
                                <Trash class="h-4 w-4" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal ver persona -->
    <div
        v-if="mostrarModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
        @click="mostrarModal = false"
    >
        <div class="w-full max-w-lg rounded-lg bg-white shadow-xl" @click.stop>
            <!-- Encabezado -->
            <div class="flex items-center justify-between border-b px-6 py-4">
                <div>
                    <h2 class="text-lg font-semibold">
                        {{ personaSeleccionada?.nombres }}
                        {{ personaSeleccionada?.apellido_paterno }}
                        {{ personaSeleccionada?.apellido_materno }}
                        {{ personaSeleccionada?.apellido_casado }}
                    </h2>
                    <p class="text-sm text-gray-500">Información personal</p>
                </div>

                <button
                    type="button"
                    class="rounded-md p-2 text-gray-500 hover:bg-gray-100"
                    title="Cerrar"
                    @click="mostrarModal = false"
                >
                    ✕
                </button>
            </div>
            <!-- Contenido -->
            <div
                v-if="personaSeleccionada"
                class="grid grid-cols-2 gap-4 px-6 py-5"
            >
                <div>
                    <p class="text-xs font-medium text-gray-500">Carnet</p>
                    <p class="mt-1 text-sm">{{ personaSeleccionada.carnet }}</p>
                </div>

                <div>
                    <p class="text-xs font-medium text-gray-500">Nombres</p>
                    <p class="mt-1 text-sm">
                        {{ personaSeleccionada.nombres }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium text-gray-500">
                        Apellido paterno
                    </p>
                    <p class="mt-1 text-sm">
                        {{ personaSeleccionada.apellido_paterno ?? "—" }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium text-gray-500">
                        Apellido materno
                    </p>
                    <p class="mt-1 text-sm">
                        {{ personaSeleccionada.apellido_materno ?? "—" }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium text-gray-500">Género</p>
                    <p class="mt-1 text-sm">
                        {{ personaSeleccionada.genero ?? "—" }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium text-gray-500">
                        Fecha de nacimiento
                    </p>
                    <p class="mt-1 text-sm">
                        {{ personaSeleccionada.fecha_nacimiento ?? "—" }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium text-gray-500">
                        Estado civil
                    </p>
                    <p class="mt-1 text-sm">
                        {{ personaSeleccionada.estado_civil ?? "—" }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium text-gray-500">Celular</p>
                    <p class="mt-1 text-sm">
                        {{ personaSeleccionada.celular ?? "—" }}
                    </p>
                </div>

                <div class="col-span-2">
                    <p class="text-xs font-medium text-gray-500">
                        Correo electrónico
                    </p>
                    <p class="mt-1 text-sm">
                        {{ personaSeleccionada.email ?? "—" }}
                    </p>
                </div>
            </div>

            <!-- Pie -->
            <div class="flex justify-end border-t px-6 py-4">
                <button
                    type="button"
                    class="rounded-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200"
                    @click="mostrarModal = false"
                >
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</template>
