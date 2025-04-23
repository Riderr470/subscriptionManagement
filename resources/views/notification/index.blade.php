<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Notifications
        </h2>
    </x-slot>

    <div class="p-6">
        <ul id="notifications" class="space-y-2 text-gray-700 dark:text-gray-200">
            <li>No notifications yet.</li>
        </ul>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Echo.channel('users')
                .listen('.new-user', (e) => {
                    appendNotification(`👤 New user: ${e.name} (${e.email})`);
                })
                .listen('.user-online', (e) => {
                    appendNotification(`🟢 ${e.name} is now online`);
                })
                .listen('.user-offline', (e) => {
                    appendNotification(`🔴 ${e.name} is now offline`);
                });

            function appendNotification(message) {
                const el = document.getElementById('notifications');
                if (el.querySelector('li')?.innerText === 'No notifications yet.') {
                    el.innerHTML = '';
                }
                const item = document.createElement('li');
                item.innerText = message;
                el.appendChild(item);
            }
        });
    </script>
</x-app-layout>