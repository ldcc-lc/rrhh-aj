<script setup>
import { ref } from "vue";
import { Eye, Pencil, UserX, UserCheck } from "lucide-vue-next";
import PersonaForm from "@/components/Personas/PersonaForm.vue";
import ConfirmationModal from "@/components/ConfirmationModal.vue";
import { router } from "@inertiajs/vue3";
import personasRoutes from "@/routes/personas";

defineProps({
    personas: Array,
});

const mostrarFormulario = ref(false);
const personaSeleccionada = ref(null);
const mostrarConfirmacion = ref(false);

function nuevaPersona() {
    personaSeleccionada.value = null;
    mostrarFormulario.value = true;
}

function editarPersona(persona) {
    personaSeleccionada.value = persona;
    mostrarFormulario.value = true;
}

//MODAL DE CONFIRMACION DESACTIVAR PERSONA
function cambiarEstadoPersona(persona) {
    personaSeleccionada.value = persona;
    mostrarConfirmacion.value = true;
}
function cancelarCambioEstado() {
    personaSeleccionada.value = null;
    mostrarConfirmacion.value = false;
}
function confirmarCambioEstado() {
    if (!personaSeleccionada.value) {
        return;
    }

    const persona = personaSeleccionada.value;

    const ruta =
        persona.estado === 1
            ? personasRoutes.inactivate(persona.id_persona)
            : personasRoutes.activate(persona.id_persona);

    mostrarConfirmacion.value = false;
    personaSeleccionada.value = null;

    router.patch(ruta);
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
                @click="nuevaPersona"
            >
                Nueva persona
            </button>

            <!-- COMPONENTE MOSTRAR FORMULARIO -->
            <PersonaForm
                :mostrar="mostrarFormulario"
                :persona="personaSeleccionada"
                @cerrar="
                    mostrarFormulario = false;
                    personaSeleccionada = null;
                "
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
                                class="rounded-full px-2.5 py-1 text-xs font-medium bg-red-100 text-red-800"
                            >
                                Inactivo
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <!--
                            <button
                                type="button"
                                class="mr-2 rounded-full bg-blue-300 p-2 text-black hover:bg-blue-400"
                                tittle="Ver persona"
                                @click="verPersona(persona)"
                            >
                                <Eye class="h-4 w-4" />
                            </button>
                            -->

                            <button
                                type="button"
                                class="mr-2 rounded-full bg-yellow-200 p-2 text-black hover:bg-yellow-300"
                                tittle="Editar persona"
                                @click="editarPersona(persona)"
                            >
                                <Pencil class="h-4 w-4" />
                            </button>

                            <button
                                type="button"
                                class="mr-2 rounded-full p-2 text-black"
                                :class="
                                    persona.estado === 1
                                        ? 'bg-gray-400 hover:bg-gray-300'
                                        : 'bg-gray-300 hover:bg-gray-400'
                                "
                                :title="
                                    persona.estado === 1
                                        ? 'Desactivar persona'
                                        : 'Reactivar persona'
                                "
                                @click="cambiarEstadoPersona(persona)"
                            >
                                <UserX
                                    v-if="persona.estado === 1"
                                    class="h-4 w-4"
                                />
                                <UserCheck v-else class="h-4 w-4" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal de confirmación de eliminación -->
        <ConfirmationModal
            :mostrar="mostrarConfirmacion"
            :titulo="
                personaSeleccionada?.estado === 1
                    ? '¿Desactivar persona?'
                    : '¿Reactivar persona?'
            "
            :mensaje="
                personaSeleccionada?.estado === 1
                    ? `¿Está seguro de desactivar a ${personaSeleccionada?.nombres} ${personaSeleccionada?.apellido_paterno}?`
                    : `¿Está seguro de reactivar a ${personaSeleccionada?.nombres} ${personaSeleccionada?.apellido_paterno}?`
            "
            :texto-confirmar="
                personaSeleccionada?.estado === 1 ? 'Desactivar' : 'Reactivar'
            "
            @cancelar="cancelarCambioEstado"
            @confirmar="confirmarCambioEstado"
        />
    </div>
</template>
