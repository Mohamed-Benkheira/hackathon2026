<x-filament-panels::page>
    @php
        $data = $this->getViewData();
    @endphp

    <div class="space-y-6">
        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <x-filament::section>
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary-600">
                        {{ number_format($data['stats']['total_institutes']) }}</div>
                    <div class="text-sm text-gray-500 mt-1">Total Institutes</div>
                    <div class="text-xs text-gray-400 mt-1">🏛️ Nationwide</div>
                </div>
            </x-filament::section>

            <x-filament::section>
                <div class="text-center">
                    <div class="text-3xl font-bold text-success-600">
                        {{ number_format($data['stats']['total_students']) }}</div>
                    <div class="text-sm text-gray-500 mt-1">Total Students</div>
                    <div class="text-xs text-gray-400 mt-1">🎓 Active Enrollment</div>
                </div>
            </x-filament::section>

            <x-filament::section>
                <div class="text-center">
                    <div class="text-3xl font-bold text-warning-600">
                        {{ number_format($data['stats']['total_teachers']) }}</div>
                    <div class="text-sm text-gray-500 mt-1">Total Teachers</div>
                    <div class="text-xs text-gray-400 mt-1">👨‍🏫 Nationwide</div>
                </div>
            </x-filament::section>

            <x-filament::section>
                <div class="text-center">
                    <div class="text-3xl font-bold text-info-600">{{ $data['stats']['pass_rate'] }}%</div>
                    <div class="text-sm text-gray-500 mt-1">National Pass Rate</div>
                    <div class="text-xs text-gray-400 mt-1">🏆 All Institutes</div>
                </div>
            </x-filament::section>
        </div>

        {{-- Institute Overview Table --}}
        <x-filament::section>
            <x-slot name="heading">
                📊 Institute Overview
            </x-slot>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Institute</th>
                            <th class="px-4 py-3 text-left font-semibold">Wilaya</th>
                            <th class="px-4 py-3 text-right font-semibold">Students</th>
                            <th class="px-4 py-3 text-right font-semibold">Teachers</th>
                            <th class="px-4 py-3 text-right font-semibold">Capacity</th>
                            <th class="px-4 py-3 text-right font-semibold">Utilization</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($data['institutes'] as $inst)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                <td class="px-4 py-3">
                                    <div class="font-medium">{{ $inst['name'] }}</div>
                                    <div class="text-xs text-gray-500">{{ $inst['code'] }}</div>
                                </td>
                                <td class="px-4 py-3">{{ $inst['wilaya'] }}</td>
                                <td class="px-4 py-3 text-right font-medium">{{ number_format($inst['students']) }}</td>
                                <td class="px-4 py-3 text-right">{{ $inst['teachers'] }}</td>
                                <td class="px-4 py-3 text-right">{{ number_format($inst['capacity']) }}</td>
                                <td class="px-4 py-3 text-right">
                                    @php
                                        $util = $inst['utilization'];
                                        $color = $util > 90 ? 'danger' : ($util > 70 ? 'warning' : 'success');
                                    @endphp
                                    <x-filament::badge :color="$color">
                                        {{ $util }}%
                                    </x-filament::badge>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-filament::section>

        {{-- Top Specialties --}}
        <x-filament::section>
            <x-slot name="heading">
                🎯 Top 10 Specialties by Enrollment
            </x-slot>

            <div class="space-y-3">
                @foreach ($data['specialties'] as $spec)
                    <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                        <span class="text-sm font-medium">{{ $spec['name'] }}</span>
                        <div class="flex items-center gap-3">
                            <div class="w-48 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-primary-600 h-2 rounded-full"
                                    style="width: {{ min(($spec['count'] / 200) * 100, 100) }}%"></div>
                            </div>
                            <span class="text-sm font-bold w-16 text-right">{{ $spec['count'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
