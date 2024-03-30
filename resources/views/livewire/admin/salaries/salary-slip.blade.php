<!-- salary-slip.blade.php -->

<!-- ... (previous code) ... -->

<div class="salary-slip">
    <h2 class="heading">Salary Slip</h2>
    <table>
        <tr>
            <th>Employee ID</th>
            <td>{{ $query->employee->name }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $query->atp_tax }}</td>
        </tr>
        <!-- Add more details as needed -->
        <tr>
    </table>
</div>

<!-- ... (remaining code) ... -->
