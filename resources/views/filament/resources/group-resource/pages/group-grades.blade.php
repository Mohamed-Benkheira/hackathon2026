<x-filament-panels::page>
    @php
        /** @var \App\Models\Group|null $group */
        $group = $this->record;
    @endphp

    <div class="space-y-6">
        <x-filament::section>
            <x-slot name="heading">
                Notes du groupe
            </x-slot>

            <x-slot name="description">
                @if ($group)
                    {{ $group->class->specialty->name_ar }}
                    — {{ $group->class->name_ar }}
                    (Groupe: {{ $group->name }})
                @else
                    Sélection du groupe…
                @endif
            </x-slot>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                <x-filament::card>
                    <div class="text-sm text-gray-500">Capacité</div>
                    <div class="text-2xl font-semibold">
                        {{ $group?->capacity ?? '—' }}
                    </div>
                </x-filament::card>

                <x-filament::card>
                    <div class="text-sm text-gray-500">Étudiants</div>
                    <div class="text-2xl font-semibold">
                        {{ $group?->current_students ?? '—' }}
                    </div>
                </x-filament::card>

                <x-filament::card>
                    <div class="text-sm text-gray-500">Places disponibles</div>
                    <div class="text-2xl font-semibold">
                        @if ($group)
                            {{ $group->capacity - $group->current_students }}
                        @else
                            —
                        @endif
                    </div>
                </x-filament::card>

                <x-filament::card>
                    <div class="text-sm text-gray-500">Semestre</div>
                    <div class="text-2xl font-semibold">
                        {{ $group?->class?->semester_number ? 'S' . $group->class->semester_number : '—' }}
                    </div>
                </x-filament::card>
            </div>
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                Notes
            </x-slot>

            <x-slot name="description">
                Utilisez la recherche et les filtres du tableau pour naviguer rapidement.
            </x-slot>

            {{ $this->table }}
        </x-filament::section>
    </div>
</x-filament-panels::page>
