<div>
    {{-- Do your work, then step back. --}}
    <div style="margin-top: 100px">
        <div class="container mb-lg-5">
            <div class="row mt-4 mb-4 justify-content-center">
                <div class="col-md-4 text-center">
                    <h3 class="font-weight-bold">
                        Terima Kasih
                    </h3>
                    <h5>Pesanan Berhasil Dibuat</h5>
                    <hr>
                    {{ $invoice->name }}
                    {{ $invoice->address }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center mb-3">
                    <div class="card border-0 rounded-lg shadow">
                        <div class="card-body">
                            <h4 class="font-weight-bold">
                                {{ $invoice->invoice }}
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 text-center mb-3">
                    <div class="card border-0 rounded-lg shadow">
                        <div class="card-body">
                            <h4 class="font-weight-bold">TOTAL :
                                {{ money_id($invoice->grand_total) }}
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        Silakan lakukan pembayaran ke salah satu rekening di bawah ini.
                        Pastikan nominal transfer sesuai dengan <strong>TOTAL</strong>
                    </div>
                </div>

                <div class="col-md-4 mt-3 text-center">
                    <div class="card h-100 border-0 rounded-lg shadow">
                        <div class="card-body">
                            <img src="{{ asset('images/payment-bca.png') }}"
                            style="width: 150px">
                            <hr>
                            <h6>Muhsin Ahadi</h6>
                            <p></p>
                            <h6 class="font-weight-bold">
                                12345678
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-3 text-center">
                    <div class="card h-100 border-0 rounded-lg shadow">
                        <div class="card-body">
                            <img src="{{ asset('images/payment-mandiri-syariah.png') }}"
                            style="width: 150px">
                            <hr>
                            <h6>Muhsin Ahadi</h6>
                            <p></p>
                            <h6 class="font-weight-bold">
                                87654321
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-3 text-center">
                    <div class="card h-100 border-0 rounded-lg shadow">
                        <div class="card-body">
                            <img src="{{ asset('images/payment-jenius.png') }}"
                            style="width: 150px">
                            <hr>
                            <h6>Muhsin Ahadi</h6>
                            <p></p>
                            <h6 class="font-weight-bold">
                                654327854
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row text-center justify-content-center mt-lg-5 mt-5">
                <div class="col-md-5">
                    Setelah melakukan transfer, silakan lakukan <strong>
                        konfirmasi pembayaran
                    </strong> melalui tombol di bawah ini:
                    <div class="konfirmasi-pembayaran mt-lg-5">
                        @if(Auth::guard('customer')->check())
                            @if($invoice->status == "pending")
                            <button data-toggle="modal" data-target="#konfirmasi-pembayaran"
                            class="btn btn-dark btn-lg btn-block mt-3 shadow">
                            Konfirmasi Pembayaran
                            </button>
                            @endif
                        @else
                        <div data-toggle="tooltip" data-placement="bottom"
                        title="Silakan Masuk Terlebih Dahulu">
                        <a href="{{ route('auth.customer.login') }}"
                        class="btn btn-dark btn-lg btn-block mt-3 shadow">
                        Konfirmasi Pembayaran</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Modal --}}
<div class="modal fade" wire:ignore.self id="konfirmasi-pembayaran"
tabindex="-1" role="dialog" aria-hidden="true">
 <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title">Konfirmasi Pembayaran</h5>
             <button type="button" class="close" data-dismiss="modal"
             aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
             <form wire:submit.prevent="confirmPayment" enctype="multipart/form-data">
                @csrf
                <div class="row d-none">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Nama Lengkap</label>
                            <input type="text" wire:model="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" readonly
                            placeholder="Nama Lengkap" value="{{ $invoice->name }}">

                            @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone" class="font-weight-bold">Nomor Telepon/WA</label>
                            <input type="text" wire:model="phone" id="phone"
                            class="form-control @error('phone') is-invalid @enderror" readonly
                            placeholder="Nomor Telepon" required value="{{ $invoice->phone }}">

                            @error('phone')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone" class="font-weight-bold">Invoice</label>
                    <input type="text" wire:model="invoice_id" id="invoice"
                    class="form-control @error('invoice_id') is-invalid @enderror" readonly
                    required value="{{ $invoice->invoice }}">

                    @error('invoice')
                    <div class="invalid-feedback" style="display: block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" wire:ignore>
                            <label class="font-weight-bold">Transfer Dari Bank</label>
                            <select wire:model="bank_transfer_from" name="bank_transfer_from"
                            id="bank_transfer_from" class="form-control select-bank" required>
                                <option value="">--Pilih Bank--</option>
                                <option value="BCA"> BCA </option>
                                <option value="Bank Mandiri"> Bank
                                <option value="BNI"> BNI </option>
                                <option value="BRI"> BRI </option>
                                <option value="CIMB"> CIMB </option>
                                <option value="BII"> BII </option>
                                <option value="BJB"> BJB </option>
                                <option value="BPR"> BPR </option>
                                <option value="Bukopin"> Bukopin </option>
                                <option value="Bank Mega"> Bank Mega </option>
                                <option value="OCBC NISP"> OCBC NISP </option>
                                <option value="Sinar Mas"> Sinar Mas </option>
                                <option value="Bank Muamalat"> Bank Muamalat </option>
                                <option value="Bank Bumi Arta"> Bank Bumi Arta </option>
                                <option value="Bank Danamon"> Bank Danamon </option>
                                <option value="Bank Mandiri Syariah"> Bank Mandiri Syariah </option>
                                <option value="Lainnya"> Lainnya </option>
                            </select>

                            @error('bank_transfer_from')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group" wire:ignore>
                            <label for="bank_transfer_to" class="font-weight-bold">
                                Transfer Ke Bank
                            </label>
                            <select wire:model="bank_transfer_to" name="bank_transfer_to"
                            class="form-control select-bank-to" required>
                                <option value="">-- Pilih Bank --</option>
                                <option value="BCA-12345678-AN.MUHSIN-AHADI">BCA</option>
                                <option value="MANDIRI-SYARIAH-87654321-AN.-MUHSIN AHADI">MANDIRI SYARIAH</option>
                                <option value="JENIUS-654327854-AN.MUHSIN-AHADI">JENIUS</option>
                            </select>
                            @error('bank_transfer_to')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="from_name" class="font-weight-bold">
                                Atas Nama
                            </label>

                            <input type="text" name="from_name" wire:model="from_name"
                            id="from_name" class="form-control" placeholder="Atas Nama" required>

                            @error('from_name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total" class="font-weight-bold">Nominal Transfer</label>
                            <input type="number" name="total" wire:model="total" class="form-control"
                            placeholder="Nominal Transfer" required>

                            @error('total')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transfer_date" class="font-weight-bold">Tanggal</label>
                            <input type="date" name="transfer_date" wire:model="transfer_date" class="form-control"
                            placeholder="Tanggal Transfer" required>

                            @error('transfer_date')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image" class="font-weight-bold">
                                Bukti Transfer (<span style="color: red">ukuran file maksimal 2MB</span>)
                            </label>
                            <input type="file" name="image" wire:model="image"
                            class="form-control" required>

                            @error('image')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                            <span style="color: red">
                            Format File: .png, .jpg, .jpeg</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Catatan</label>
                    <textarea name="note" id="note" rows="2" class="form-control"
                    wire:model="note" placeholder="Catatan">{{ $note }}</textarea>
                </div>

                <button type="submit" class="btn btn-dark btn-block shadow">
                    Kirim Bukti Pembayaran
                </button>
             </form>
         </div>
     </div>
 </div>
</div>

<script>
    $(document).ready(function(){
        // $(".select-bank-from, .select-bank-to").select2({
        //     theme: 'bootstrap4',
        //     width: 'style',
        // });

        $(".select-bank-from").on("change", function(e){
            @this.set('bank_transfer_from', e.target.value)
        });

        $(".select-bank-to").on("change", function(e){
            @this.set('bank_transfer_to', e.target.value)
        });
    });
</script>
