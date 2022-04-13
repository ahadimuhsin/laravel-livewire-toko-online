<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-shopping-cart"></i> Receipt Orders
            </div>
            <div class="card-body">
                <form wire:submit.prevent="update">
                    <div class="form-group" wire:ignore>
                        <label>Input Receipt Order</label>
                        <input type="hidden" wire:model="invoiceId">
                        <input type="text" wire:model="receipt" id="receipt"
                        class="form-control" placeholder="Nomor Resi">
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
