<script src="/js/bootstrap.min.js" defer></script>
<script src="/js/minAjax.js" defer></script>
<script src="/js/alpinejs.min.js" defer></script>


<main x-data="{
        qmonth: 1,
        qyear: 2025,
        mr: [],
        mrmill: '', // refer MR modal
        mrdeliverydate: '', // refer MR modal
        error: null,
        fetchMR({mr}) {
            minAjax({
                url: '/rds/api/mr/get',
                type: 'GET',
                data: {
                    qmonth: this.qmonth,
                    qyear: this.qyear,
                },
                success: (response) => {
                    data = JSON.parse(response);
                    this.mr = data.mr;
                }
            });
        },
        createMR({mrmill, mrdeliverydate}) {
            minAjax({
                url: '/rds/api/mr/create',
                type: 'POST',
                data: {
                    mrmill: this.mrmill,
                    mrdeliverydate: this.mrdeliverydate,
                },
                success: (response) => {
                    data =  JSON.parse(response);
                    this.qmonth = data.month;
                    this.qyear = data.year;
                    
                    // modify the select too
                    document.getElementById('select-month').value = this.qmonth;
                    document.getElementById('select-year').value = this.qyear;

                    this.fetchMR($data);
                }
            });
        },
        deleteMR(mrid) {
            minAjax({
                url: '/rds/api/mr/delete',
                type: 'POST',
                data: {
                    mrid: mrid,
                },
                success: (response) => {
                    data = JSON.parse(response);
                    
                    this.qmonth = data.month;
                    this.qyear = data.year;
                    
                    // modify the select too
                    document.getElementById('select-month').value = this.qmonth;
                    document.getElementById('select-year').value = this.qyear;

                    this.fetchMR($data);
                }
            });
        }
    }" x-init="fetchMR($data)">


    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-auto">
                    <h2>
                        Mill Report
                    </h2>
                </div>
                <div class="col" x-on:mrtoday="
                    document.getElementById('mrdeliverydate').valueAsDate = new Date();
                ">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mrModal" x-on:click="$dispatch('mrtoday')">
                        New MR
                    </button>
                </div>
            </div>
        </div>


        <div class="p-0 my-4">

            <div class="row">
                <div class="col-2">
                    <label for="select-month" class="form-label">Month</label>
                    <select class="form-select" id="select-month" x-on:change="qmonth = $el.value">
                        <option value="1">01</option>
                        <option value="2">02</option>
                        <option value="3">03</option>
                        <option value="4">04</option>
                        <option value="5">05</option>
                        <option value="6">06</option>
                        <option value="7">07</option>
                        <option value="8">08</option>
                        <option value="9">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div class="col-2">
                    <label for="select-year" class="form-label">Year</label>
                    <select class="form-select" id="select-year" x-on:change="qyear = $el.value">
                        <option value="2025">2025</option>
                    </select>
                </div>
                <div class="col">
                    <div>
                        <label class="form-label">&nbsp;</label>
                    </div>
                    <button class="btn btn-primary" x-on:click="fetchMR($data)">Search</button>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>no</th>
                    <th>mill no</th>
                    <th>mill name</th>
                    <th>delivery date</th>
                    <th>status</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody id="table-mr">
                <template x-if="Object.keys(mr).length === 0">
                    <tr>
                        <td colspan="5" style="text-align:center;">no data</td>
                    </tr>
                </template>
                <template x-for="(item, index) in mr" :key="item.id">
                    <tr>
                        <td x-text="index+1"></td>
                        <td x-text="item.mill_no"></td>
                        <td x-text="item.mill_name"></td>
                        <td x-text="item.delivery_date"></td>
                        <td x-text="item.status"></td>
                        <td>
                            <button class="btn btn-danger btn-sm" x-on:click="deleteMR(item.id)">delete</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="mrModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="mrModalLabel">New Mill Report</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <label for="mrmill" class="form-label">Mill</label>
                            <select class="form-select" id="mrmill" x-init="mrmill = $el.value" x-on:change="mrmill = $el.value">
                            <?php foreach ($mills as $key=>$row):?>
                                <option value="<?= $row['id'] ?>"><?= $row['mill_no'].' '.$row['mill_name']; ?></option>
                            <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <label for="mrdeliverydate" class="form-label">Delivery Date</label>
                            <input type="date" class="form-control" id="mrdeliverydate" x-init="mrdeliverydate = $el.value" x-on:change="mrdeliverydate = $el.value">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" x-on:click="createMR($data)" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>
</main>


<script>
//
</script>