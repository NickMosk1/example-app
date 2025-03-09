<div class="lead-table-container">
    <table class="lead-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>ФИО заявителя</th>
                <th>Количество продуктов в заявке</th>
                <th>Описание продукта</th>
                <th>Статус заявки</th>
                <th>Создана</th>
                <th>Обновлена</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $lead)
                <tr>
                    <td>{{ $lead->id }}</td>
                    <td>{{ $lead->full_name }}</td>
                    <td>{{ $lead->quantity }}</td>
                    <td>{{ $lead->type }}</td>
                    <td class="status-cell">
                        <span class="status-badge status-{{ str_replace(' ', '_', strtolower($lead->status)) }}">
                            @switch($lead->status)
                                @case('pending')
                                    В ожидании
                                @break
                                @case('in_progress')
                                    В работе
                                @break
                                @case('sold_to_partner')
                                    Продана партнеру
                                @break
                                @case('cancelled')
                                    Отменена
                                @break
                                @default
                                    Неизвестный статус
                            @endswitch
                        </span>
                    </td>
                    <td>{{ $lead->created_at }}</td>
                    <td>{{ $lead->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $leads->links() }}

    @include('customPages.leadsTablePage.leads-table-page-styles')
</div>