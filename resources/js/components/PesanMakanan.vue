<template>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Order Baru</h4>
                    <p class="text-muted m-b-30 font-14">Silahkan pilih masakan</p>
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4" v-for="masakan in JSON.parse(masakans)" :key="masakan.id">
                                    <div class="card m-b-30" style='box-shadow:none; border: 1px solid #ddd'>
                                        <img class="card-img-top " :src="`/storage/masakan/${masakan.image_name}`" alt="Card image cap">
                                        <div class="card-body text-center">
                                            <h4 class="card-title font-20 mt-0">{{ masakan.name }}</h4>
                                            <p class="card-title text-muted  mt-0">Rp {{ number_format(masakan.harga) }}</p>

                                            <button @click="addToPesanan(masakan)" class="btn btn-primary waves-effect waves-light">Pesan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <template v-if="!pesananSukses">
                            <div class="col-md-6">
                                <h3>Detail Pesanan</h3>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Masakan</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(pesanan,index) in pesanans" :key="pesanan.id">
                                                <td>{{index+1}}</td>
                                                <td>{{pesanan.name}}</td>
                                                <td>Rp <input type="text" name="" class='borderless' v-model="pesanans[index].totalPrice" id=""></td>
                                                <td>
                                                    <button class='btn btn-sm btn-primary' @click="pesanans[index].quantity--; updatePrice(index)">-</button>
                                                    <input type="text"  name="" id="" value="1" style='width:50px; border-left:none; border-right:none; border-top:1px solid #444;border-bottom:1px solid #444' v-model="pesanans[index].quantity">
                                                    <button class='btn btn-sm btn-primary' @click="pesanans[index].quantity++; updatePrice(index)">+</button></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Total: Rp {{ number_format(totalPrice) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <form action="" method="get" class='form-inline float-right mb-3'  v-if="pesanans.length > 0">
                                    <p style='margin-top:13px'>Pilih Meja</p>
                                    <select name="meja" id="" class="form-control ml-2" v-model="meja_id">
                                        <option :value="meja.id" v-for="meja in JSON.parse(mejas)" :key="meja.id">{{meja.name}}</option>
                                    </select>
                                </form>
                                <div class="clearfix"></div>
                                <button class='btn btn-primary float-right' v-if="pesanans.length > 0" @click="pesan()">Pesan</button>
                            </div>
                        </template>
                        <template v-else>
                            <div class="col-md-6">
                                <div class="alert alert-success"><i class="ti ti-check"></i> Terima kasih, Pesanan Anda Akan Segera Diproses. <a href="#" @click="pesananSukses = !pesananSukses;pesanans=[] ">Pesan Lagi?</a></div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</template>
<script>
import Swal from 'sweetalert2'

export default {
    props: ['masakans', 'mejas', 'userid'],
    data() {
        return {
            pesanans: [],
            totalPrice: 0,
            pesananSukses: false,
            meja_id:1,
            keterangan: ''
        }
    },
    mounted() {
        console.log(this.masakans);
        
    },
    methods: {
        addToPesanan(masakan) {
            masakan.quantity=1;
            masakan.totalPrice = masakan.harga * masakan.quantity;
            this.pesanans.push(masakan);
            this.totalPrice += masakan.harga;
        },
        updatePrice(index) {
            this.pesanans[index].totalPrice = this.pesanans[index].harga * this.pesanans[index].quantity;
            this.updateTotalPrice();
        },
        updateTotalPrice() {
            let thePrice = 0;
            this.pesanans.forEach(pesanan => {
                thePrice += pesanan.totalPrice;
            });
            this.totalPrice = thePrice;
        },
        pesan() {
            axios.post("/api/v1/order", {pesanans:this.pesanans, meja_id:this.meja_id, keterangan: this.keterangan, user_id:this.userid})
                .then(res => {
                    console.log('sukses order');
                    Swal.fire({
                        title: 'Suksess!',
                        text: 'Pesanan Anda Akan Segera Diproses',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            
            this.pesananSukses = true;
            this.totalPrice = 0;
        },
        number_format(number, decimals, dec_point, thousands_sep) {
            var n = number, prec = decimals;

            var toFixedFix = function (n,prec) {
                var k = Math.pow(10,prec);
                return (Math.round(n*k)/k).toString();
            };

            n = !isFinite(+n) ? 0 : +n;
            prec = !isFinite(+prec) ? 0 : Math.abs(prec);
            var sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep;
            var dec = (typeof dec_point === 'undefined') ? '.' : dec_point;

            var s = (prec > 0) ? toFixedFix(n, prec) : toFixedFix(Math.round(n), prec); 
            //fix for IE parseFloat(0.55).toFixed(0) = 0;

            var abs = toFixedFix(Math.abs(n), prec);
            var _, i;

            if (abs >= 1000) {
                _ = abs.split(/\D/);
                i = _[0].length % 3 || 3;

                _[0] = s.slice(0,i + (n < 0)) +
                    _[0].slice(i).replace(/(\d{3})/g, sep+'$1');
                s = _.join(dec);
            } else {
                s = s.replace('.', dec);
            }

            var decPos = s.indexOf(dec);
            if (prec >= 1 && decPos !== -1 && (s.length-decPos-1) < prec) {
                s += new Array(prec-(s.length-decPos-1)).join(0)+'0';
            }
            else if (prec >= 1 && decPos === -1) {
                s += dec+new Array(prec).join(0)+'0';
            }
            return s; 
        }
    }
}
</script>
<style>
    .borderless {
        border:none;
        background-color: transparent
    }
    .card-img-top {
        object-fit:cover;
        height:170px;
    }
</style>