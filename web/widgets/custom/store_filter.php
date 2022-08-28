<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Filters</h3>
    </div>
    <div class="card-body">
        <!-- <form class="form-horizontal" id="Filters">
            <fieldset>
                <div class="form-group no-mt">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value=".trade"> Trades </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value=".sale"> Sales </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value=".preorder"> Preorders </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value=".bid"> Bids </label>
                    </div>
                </div>
            </fieldset>
            <button class="btn btn-danger btn-block no-mb mt-2" id="Reset"><i class="zmdi zmdi-delete"></i> Clear Filters</button>
        </form> -->
        <form class="form-horizontal">
            <h4>Sort by</h4>
            <div class="form-group">
                <select id="SortSelect" class="form-control selectpicker" data-dropup-auto="false">
                    <option value="price:asc">Price ASC</option>
                    <option value="price:desc">Price DESC</option>
                    <option value="date:asc">Release ASC</option>
                    <option value="date:desc">Release DESC</option>
                </select>
            </div>
        </form>
    </div>
</div>