{{-- @dd($booking->barang) --}}
@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Perbaiki & Modifikasi</p>
                        <h1>Detail Layanan</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="card">
                <div class="card-title">
                    <h3 class="text-center mt-2">Rincian Layanan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Nama Pemesan : <p>{{ $booking->nama_pemesan }}</p>
                                    </h5>
                                    <h5>No. Telepon : <p>{{ $booking->no_telp }}</p>
                                    </h5>
                                    <h5>Alamat : <p>{{ $booking->alamat == null ? '-' : $booking->alamat }}</p>
                                    </h5>
                                    <h5>Tipe Mobil : <p>{{ $booking->tipe_mobil }}</p>
                                    </h5>
                                    <h5>Tempat Perbaikan : <p>
                                            {{ $booking->tempat_perbaikan == 'dirumah' ? 'Di Rumah' : ' Di Bengkel' }}</p>
                                    </h5>
                                    <h5>Waktu (Tanggal & Jam) : <p>{{ $booking->waktu }}</p>
                                    </h5>
                                    <h5>Tipe Pembayaran : <p>
                                            {{ $booking->tipe_bayar == 'website' ? 'Melalui Website' : 'COD' }}</p>
                                    </h5>
                                    <h5>
                                        Montir Pengerjaan :
                                        <p>{{ $booking->montir->nama }} | {{ $booking->montir->no_telp }}</p>
                                        <p><img src="{{ asset('storage/' . $booking->montir->picture_montir) }}"
                                                alt="{{ $booking->montir->nama }}" class="rounded" width="120"></p>
                                    </h5>
                                    <h5>
                                        Status :
                                        @if ($booking->status == 'Menunggu Konfirmasi')
                                            <p>
                                                <span class="badge bg-secondary p-2">{{ $booking->status }}</span>
                                            </p>
                                        @endif

                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive mb-5">
                                        <table class="table">
                                            <h5>Pelayanan Dipesan</h5>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nama Pelayanan</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($booking->pelayanan as $pelayanan)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $pelayanan->nama_pelayanan }}</td>
                                                        <td>Rp. {{ number_format($pelayanan->harga) }}</td>
                                                        <td>
                                                            <form action="/pelayanan/hapus/{{ $pelayanan->id }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <input type="hidden" name="id"
                                                                    value="{{ $booking->id }}">
                                                                <button class="btn btn-sm btn-danger"><i
                                                                        class="fas fa-solid fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot class="mt-4">
                                                <tr>
                                                    <td colspan="4"><span class="fw-bold fs-6">Kendala Lain</span>
                                                        : {{ $booking->kendala == null ? '-' : $booking->kendala }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"><span class="fw-bold fs-6">Total Biaya Pelayanan
                                                            (Sementara)</span> : Rp. {{ number_format($booking->total) }}
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <h5>Barang Dipesan</h5>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">Nama Barang</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Kuantitas</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($booking->barang as $barang)
                                                    <tr>
                                                        <th><img src="{{ asset('storage/' . $barang->picture_barang) }}"
                                                                alt="{{ $booking->nama_barang }}" width="40"></th>
                                                        <td>{{ $barang->nama_barang }}</td>
                                                        <td>Rp. {{ number_format($barang->harga) }}</td>
                                                        <td>
                                                            <form action="/layananBarang/{{ $barang->id }}"
                                                                method="post">
                                                                @csrf
                                                                @method('patch')
                                                                <input type="hidden" name="id"
                                                                    value="{{ $booking->id }}">
                                                                <input type="number" name="kuantitas" class="kuantitas"
                                                                    id="kuantitas" data-id="{{ $barang->id }}"
                                                                    value="{{ $barang->pivot->kuantitas }}">
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="/layananBarang/hapus/{{ $barang->id }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <input type="hidden" name="id"
                                                                    value="{{ $booking->id }}">
                                                                <button class="btn btn-sm btn-danger"><i
                                                                        class="fas fa-solid fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5"><span class="fw-bold fs-6">Total Harga Barang</span>
                                                        : Rp. {{ number_format($booking->total_harga_barang) }}
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer mt-3">
                                    <h4>
                                        Total Biaya (Sementara) : Rp.
                                        {{ number_format($booking->total + $booking->total_harga_barang) }}
                                    </h4>
                                </div>
                            </div>
                            {{-- @if ($checkout->payment_status == '1')
                                <button class="btn btn-lg btn-warning text-light mt-4" id="bayar">Bayar</button>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end products -->
@endsection

@section('script')
    {{-- <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    

    
    @if ($checkout->payment_status == '1')
        <script>
            $('#bayar').on('click', function(e) {
                e.preventDefault();
                snap.pay('{{ $checkout->snap_token }}', {
                    onSuccess: function(result) {
                        console.log(result);
                        window.location.href = '/pesanan'
                    }
                });
            })
        </script>
    @endif --}}

    <script>
        function debounce(func, timeout = 1000) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, timeout);
            };
        }

        document.querySelectorAll('.kuantitas').forEach(item => {
            item.addEventListener('input', debounce(function() {
                const id = item.dataset.id;
                const kuantitas = item.value;
                const idBooking = $('input[name="id"]').val();
                const url = `/layananBarang/${id}`;
                $.ajax({
                    url: url,
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ @csrf_token() }}'
                    },
                    data: {
                        kuantitas: kuantitas,
                        id: idBooking
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }, 1000));
        });
    </script>
@endsection
