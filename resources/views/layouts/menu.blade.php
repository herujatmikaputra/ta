@if(Auth::user()->role == 1)
<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('members*') ? 'active' : '' }}">
    <a href="{!! route('members.index') !!}"><i class="fa fa-edit"></i><span>Members</span></a>
</li>

<li class="{{ Request::is('sewas*') ? 'active' : '' }}">
    <a href="{!! route('sewas.index') !!}"><i class="fa fa-edit"></i><span>Jadwal Sewa</span></a>
</li>

<li class="{{ Request::is('nonSewas*') ? 'active' : '' }}">
    <a href="{!! route('nonSewas.index') !!}"><i class="fa fa-edit"></i><span>Harga Non Sewa</span></a>
</li>

<li class="{{ Request::is('transaksis*') ? 'active' : '' }}">
    <a href="{!! route('transaksis.index') !!}"><i class="fa fa-edit"></i><span>Transaksis</span></a>
</li>

<li class="{{ Request::is('checkin') ? 'active' : '' }}">
    <a href="{!! route('transaksis.checkin') !!}"><i class="fa fa-edit"></i><span>Check In Lapangan</span></a>
</li>

<li class="{{ Request::is('laporan*') ? 'active' : '' }}">
    <a href="{!! route('laporan.index') !!}"><i class="fa fa-edit"></i><span>Laporan</span></a>
</li>
@elseif(Auth::user()->role == 2)
    <li class="{{ Request::is('members*') ? 'active' : '' }}">
        <a href="{!! route('members.index') !!}"><i class="fa fa-edit"></i><span>Members</span></a>
    </li>

    <li class="{{ Request::is('sewas*') ? 'active' : '' }}">
        <a href="{!! route('sewas.index') !!}"><i class="fa fa-edit"></i><span>Jadwal Sewa</span></a>
    </li>

    <li class="{{ Request::is('nonSewas*') ? 'active' : '' }}">
        <a href="{!! route('nonSewas.index') !!}"><i class="fa fa-edit"></i><span>Harga Non Sewa</span></a>
    </li>

    <li class="{{ Request::is('transaksis*') ? 'active' : '' }}">
        <a href="{!! route('transaksis.index') !!}"><i class="fa fa-edit"></i><span>Transaksis</span></a>
    </li>

    <li class="{{ Request::is('checkin') ? 'active' : '' }}">
        <a href="{!! route('transaksis.checkin') !!}"><i class="fa fa-edit"></i><span>Check In Lapangan</span></a>
    </li>
@elseif(Auth::user()->role == 3)
    <li class="{{ Request::is('member/transaksi*') ? 'active' : '' }}">
        <a href="{!! route('transaksi.index') !!}"><i class="fa fa-edit"></i><span>Transaksi</span></a>
    </li>
    <li class="{{ Request::is('member/profile*') ? 'active' : '' }}">
        <a href="{!! route('member.profile') !!}"><i class="fa fa-edit"></i><span>Profile</span></a>
    </li>
@endif
