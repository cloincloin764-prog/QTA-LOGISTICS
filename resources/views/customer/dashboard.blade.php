@extends('layouts.app')

@section('content')
<div id="driver-dashboard">
    <h1>Your Assigned Parcels</h1>
    <ul id="parcel-list">
        <!-- List of parcels assigned to the driver -->
    </ul>
</div>

<script>
    fetch('/api/driver/dashboard')
        .then(response => response.json())
        .then(data => {
            const parcelList = document.getElementById('parcel-list');
            data.forEach(parcel => {
                let li = document.createElement('li');
                li.innerText = `Tracking Code: ${parcel.tracking_code} - Status: ${parcel.status}`;
                parcelList.appendChild(li);
            });
        });
</script>
@endsection