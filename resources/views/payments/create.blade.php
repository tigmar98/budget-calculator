<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payments') }}
            <a href="/balance" class="float-right">
                {{ $balance }} $
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ url('payments') }}" method="POST">
                        <input type="number" name="amount" step="0.01" required>
                        <select name="payment_type">
                            <option value="1">Earning</option>
                            <option value="2" selected="selected">Spending</option>
                        </select>
                        <input type="submit" name="submit" value="Submit">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
