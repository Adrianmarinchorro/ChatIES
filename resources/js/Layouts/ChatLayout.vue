<template>
<div>
    <nav class="flex items-center justify-between  bg-teal-800 p-3">
        <div class="mr-6 pl-2">
            <Link :href="route('chat')">
                <ApplicationLogo/>
            </Link>
        </div>
        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto lg:justify-end">
            <Dropdown align="right" width="48" class="hidden sm:block">
                <template #trigger>
                    <span class="inline-flex rounded-md">
                        <button
                            type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-stone-900  bg-teal-600  hover:text-teal-300  focus:outline-none transition ease-in-out duration-150"
                        >
                            {{ $page.props.auth.user.username }}

                            <svg
                                class="ml-2 -mr-0.5 h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </span>
                </template>

                <template #content>
                    <DropdownLink class="bg-gray-700" :href="route('logout')" method="post" as="button">
                        Desconectar
                    </DropdownLink>
                    <DropdownLink class="bg-gray-700" :href="route('deletehistory')" method="delete" as="button">
                        Borrar historial
                    </DropdownLink>
                </template>
            </Dropdown>

            <div class="flex justify-end lg:hidden">
                <div class="dropdown dropdown-end ">
                    <label tabindex="0" class="btn m-1">Click</label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-gray-700 rounded-box w-52">
                      <li class="text-white">
                        <Link :href="route('logout')" class="hover:bg-gray-600">
                            Desconectar
                        </Link>
                      </li>
                      <li class="text-white">
                        <Link :href="route('deletehistory')" class="hover:bg-gray-600">
                            Borrar historial
                        </Link>
                      </li>
                    </ul>
                  </div>
            </div>

        </div>
    </nav>

    <main>
        <slot />
    </main>
</div>
</template>


<script>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import Dropdown from '@/Components/Dropdown.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

export default {
    data(){
        return {
            showResponse: true,
        }
    },
    components: {
        ApplicationLogo, DropdownLink, Dropdown, ResponsiveNavLink, Link
    }
}
</script>
