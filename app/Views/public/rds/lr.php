<div x-data="{
    qmonth: 1,
    qyear: 2025,
    lr: [],
    fetchLR() {
        minAjax({
            url: '/rds/api/lr/get',
            type: 'GET',
            data: {
                month: this.qmonth,
                year: this.qyear,
            },
            success: (response) => {
                data = JSON.parse(response);
                this.lr = data.lr;
            }
        });
    },
}" x-init="fetchLR">
    <div>
        <p>
            <a href="/">home</a>
            >
            <a href="/public/rds">rds</a>        
            >
            <a href="/public/rds/lr">lr</a>
        </p>
    </div>

    <div>
        <h1>Licensee Report (LR)</h1>
    </div>

    <div class="w3-grid w3-grid-padding" style="grid-template-columns: 250px 200px; align-items: center;">
        <div>
            <input class="w3-input w3-border" type="month" x-on:change="updateMonth($el.value)">
        </div>
        <div>    
            <button class="w3-button w3-red w3-round-large" x-on:click="fetchLR">Search</button>
        </div>
    </div>

    <br>

    <div>
        <table id="table-report" class="w3-table w3-border w3-bordered">
            <tr>
                <th>No.</th>
                <th>License No</th>
                <th>Licensee</th>
                <th>Email</th>
                <th>Contact person</th>
                <th>Delivery date</th>
                <th>Status</th>
            </tr>
            <tbody>
                <template x-if="Object.keys(lr).length === 0">
                    <tr>
                        <td colspan="6" style="text-align:center;">no data</td>
                    </tr>
                </template>
                <template x-for="(item, index) in lr" :key="item.id">
                    <tr>
                        <td x-text="index+1"></td>
                        <td x-text="item.license_no"></td>
                        <td x-text="item.licensee_name"></td>
                        <td x-text="item.email"></td>
                        <td x-text="item.contact_person"></td>
                        <td x-text="item.delivery_date"></td>
                        <td x-text="item.status"></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</div>