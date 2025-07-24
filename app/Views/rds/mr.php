<script src="/js/minAjax.js" defer></script>
<script src="/js/alpinejs.min.js" defer></script>


<main x-data="{
        qmonth: 1,
        qyear: 2025,
        mr: [],
        error: null,
        set setMR(mr) { this.mr = mr },
        fetchMR({mr}) {
            minAjax({
                url: '/rds/mr/get',
                type: 'GET',
                data: {
                    qmonth: this.qmonth,
                    qyear: this.qyear,
                },
                success: (response) => {
                    data = JSON.parse(response);
                    this.mr = data.mr;
                    console.table(this.mr);
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
                <div class="col">
                    <button class="btn btn-primary">New MR</button>
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
                            <a href="/rds/mr/delete">X</a>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</main>

<script>
//
</script>