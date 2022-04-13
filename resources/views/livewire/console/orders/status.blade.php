<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-shopping-cart"></i> Status Orders
            </div>
            <div class="card-body">
                <form wire:submit.prevent="update">
                    <div class="form-group" wire:ignore>
                        <label>Change Status Order</label>
                        <input type="hidden" wire:model="invoiceId">
                        <select wire:model="status" required class="select2 form-control">
                            <option value="">-- STATUS --</option>
                            <option value="payment_invalid">Pembayaran Tidak Valid</option>
                            <option value="progress">Pesanan Diproses</option>
                            <option value="shipping">Pesanan Dikirim</option>
                            <option value="Done">Pesanan Selesai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-1 btn-submit">
                        Update
                    </button>
                    <button type="reset" class="btn btn-warning btn-reset">
                        Reset
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.select2').select2({
            theme: 'bootstrap4',
            width: 'style'
        });
        $('.select2').on('change', function(e){
            @this.set('status', e.target.value);
        });
    })
</script>
