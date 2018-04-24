<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> Edit Data Sekolah

      <ul class="nav nav-pills card-header-pills pull-right">
        <li class="nav-item">
          <button class="btn btn-primary btn-sm" role="button" @click="back">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <vue-form class="form-horizontal form-validation" :state="state" @submit.prevent="onSubmit">
        <div class="form-row">
          <div class="col-md">
            <validate tag="div">
              <label for="nama">Nama Sekolah</label>
              <input class="form-control" v-model="model.nama" required autofocus name="nama" type="text" placeholder="Nama Sekolah">

              <field-messages name="nama" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Label is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="npsn">NPSN</label>
              <input class="form-control" v-model="model.npsn" name="npsn" type="text" placeholder="NPSN">

              <field-messages name="npsn" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="alamat">Alamat</label>
              <input class="form-control" v-model="model.alamat" name="alamat" type="text" placeholder="Alamat">

              <field-messages name="alamat" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <!-- <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="logo">Logo</label>
              <input class="form-control" v-model="model.logo" name="logo" type="text" placeholder="Logo">
        
              <field-messages name="logo" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>
        
        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="foto_gedung">Foto Gedung</label>
              <input class="form-control" v-model="model.foto_gedung" name="foto_gedung" type="text" placeholder="Foto Gedung">
        
              <field-messages name="foto_gedung" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div> -->

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="province_id">Provinsi</label>
              <v-select name="province_id" v-model="model.province" :options="province" @input="changeProvince" placeholder="Provinsi" required></v-select>

              <field-messages name="province_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">provinsi is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="city_id">Kabupaten/Kota</label>
              <v-select name="city_id" v-model="model.city" :options="city" @input="changeCity" placeholder="Kabupaten/Kota" required></v-select>

              <field-messages name="city_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Kabupaten is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="district_id">Kecamatan</label>
              <v-select name="district_id" v-model="model.district" :options="district" @input="changeDistrict" placeholder="Kecamatan" required></v-select>

                <field-messages name="district_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Kota is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="village_id">Kelurahan/Desa</label>
              <v-select name="village_id" v-model="model.village" :options="village" placeholder="Kelurahan/Desa" required></v-select>

              <field-messages name="village_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Desa is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="no_telp">No Telepon</label>
              <input class="form-control" v-model="model.no_telp" name="no_telp" type="text" placeholder="No Telepon">

              <field-messages name="no_telp" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="email">E-mail</label>
              <input class="form-control" v-model="model.email" name="email" type="text" placeholder="E-mail">

              <field-messages name="email" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
            <label for="kode_zona">Zona </label>
            <v-select name="kode_zona" v-model="model.kode_zona" :options="master_zona" class="mb-4"></v-select>

            <field-messages name="kode_zona" show="$invalid && $submitted" class="text-danger">
              <small class="form-text text-success">Looks good!</small>
              <small class="form-text text-danger" slot="required">Zona is a required field</small>
            </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
            <label for="jenis_sekolah_id">Jenis Sekolah</label>
            <v-select name="jenis_sekolah_id" v-model="model.jenis_sekolah" :options="jenis_sekolah" class="mb-4"></v-select>

            <field-messages name="jenis_sekolah_id" show="$invalid && $submitted" class="text-danger">
              <small class="form-text text-success">Looks good!</small>
              <small class="form-text text-danger" slot="required">Jenis Sekolah is a required field</small>
            </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
            <label for="user_id">Username</label>
            <v-select name="user_id" v-model="model.user" :options="user" class="mb-4"></v-select>

            <field-messages name="user_id" show="$invalid && $submitted" class="text-danger">
              <small class="form-text text-success">Looks good!</small>
              <small class="form-text text-danger" slot="required">Username is a required field</small>
            </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <button type="submit" class="btn btn-primary">Submit</button>

            <button type="reset" class="btn btn-secondary" @click="reset">Reset</button>
          </div>
        </div>

      </vue-form>
    </div>
  </div>
</template>

<script>

import swal from 'sweetalert2';

export default {
  mounted() {
    axios.get('api/sekolah/' + this.$route.params.id + '/edit')
      .then(response => {
        if (response.data.status == true) {

          this.model.nama           = response.data.sekolah.nama;
          this.model.old_user_id    = response.data.sekolah.user_id;
          this.model.user           = response.data.sekolah.user.name;
          this.model.jenis_sekolah  = response.data.sekolah.jenis_sekolah;
          this.model.npsn           = response.data.sekolah.npsn;
          this.model.old_npsn       = response.data.sekolah.npsn;
          this.model.alamat         = response.data.sekolah.alamat;
          this.model.logo           = response.data.sekolah.logo;
          this.model.foto_gedung    = response.data.sekolah.foto_gedung;
          this.model.province       = response.data.sekolah.province;
          this.model.city           = response.data.sekolah.city;
          this.model.district       = response.data.sekolah.district;
          this.model.village        = response.data.sekolah.village;
          this.model.no_telp        = response.data.sekolah.no_telp;
          this.model.email          = response.data.sekolah.email;
          this.model.kode_zona      = response.data.sekolah.master_zona;
          //this.model.master_zonasona =response.data.master_zona_id;

        } else {
          alert('Failed');
        }
      })
      .catch(function(response) {
        alert('Break');
        window.location.href = '#/admin/sekolah';
      });

      axios.get('api/sekolah/create')
      .then(response => {
        if (response.data.status == true && response.data.error == false) {
          this.master_zona    = response.data.master_zonas;
          this.model.user     = response.data.current_user;

          if(response.data.user_special == true){
            this.user = response.data.users;
          }else{
            this.user.push(response.data.users);
          }
        } else {
          swal(
            'Failed',
            'Oops... '+response.data.message,
            'error'
          );

          app.back();
        }
      })
      .catch(function(response) {
        swal(
          'Not Found',
          'Oops... Your page is not found.',
          'error'
        );

        app.back();
      });
       axios.get('api/jenis-sekolah/get')
      .then(response => {
        if (response.data.status == true && response.data.error == false) {
          this.jenis_sekolah = response.data.jenis_sekolahs;
        } else {
          swal(
            'Failed',
            'Oops... '+response.data.message,
            'error'
          );

          app.back();
        }
      })
      .catch(function(response) {
        swal(
          'Not Found',
          'Oops... Your page is not found.',
          'error'
        );

        app.back();
      });

      axios.get('api/wilayah-indonesia/province/get')
      .then(response => {
        if (response.data.status == true && response.data.error == false) {
          this.province = response.data.provinces;
        } else {
          swal(
            'Failed',
            'Oops... '+response.data.message,
            'error'
          );

          app.back();
        }
      })
      .catch(function(response) {
        swal(
          'Not Found',
          'Oops... Your page is not found.',
          'error'
        );

        app.back();
      });
  },
  data() {
    return {
      state: {},
      model: {
        nama              : "",
        npsn              : "",
        jenis_sekolah_id  : "",
        alamat            : "",
        logo              : "",
        foto_gedung       : "",
        province_id       : "",
        city_id           : "",
        district_id       : "",
        village_id        : "",
        no_telp           : "",
        email             : "",
        kode_zona         : "",
        user_id           : "",
        created_at        : "",
        updated_at        : "",

        jenis_sekolah     : "",
        province          : "",
        city              : "",
        district          : "",
        village           : "",
        master_zona       : "",
        user              : "",
      },
      jenis_sekolah : [],
      province      : [],
      city          : [],
      district      : [],
      village       : [],
      master_zona   : [],
      user          : [],
    }
  },
  methods: {
    onSubmit: function() {
      let app = this;

      if (this.state.$invalid) {
        return;
      } else {
        axios.put('api/sekolah/' + this.$route.params.id, {

            nama:               this.model.nama,
            user_id:            this.model.user.id,
            old_user_id:        this.model.old_user_id,
            jenis_sekolah_id:   this.model.jenis_sekolah.id,
            npsn:               this.model.npsn,
            old_npsn:           this.model.old_npsn,
            alamat:             this.model.alamat,
            logo:               this.model.logo,
            foto_gedung:        this.model.foto_gedung,
            province_id:        this.model.province.id,
            city_id:            this.model.city.id,
            district_id:        this.model.district.id,
            village_id:         this.model.village.id,
            no_telp:            this.model.no_telp,
            email:              this.model.email,
            kode_zona:          this.model.kode_zona.id,
          })
          .then(response => {
            if (response.data.status == true) {
              if(response.data.error == false){
                swal(
                  'Updated',
                  'Yeah!!! Your data has been updated.',
                  'success'
                );

                app.back();
              }else{
                swal(
                  'Failed',
                  'Oops... '+response.data.message,
                  'error'
                );
              }
            } else {
              swal(
                'Failed',
                'Oops... '+response.data.message,
                'error'
              );

              app.back();
            }
          })
          .catch(function(response) {
            swal(
              'Not Found',
              'Oops... Your page is not found.',
              'error'
            );

            app.back();
          });
      }
    },
    changeProvince() {
      if (typeof this.model.province.id === 'undefined') {
        this.model.city = "";
      } else {
        // this.model.city = "";

        axios.get('api/wilayah-indonesia/city/get/by-province/'+this.model.province.id)
          .then(response => {
            if (response.data.status == true && response.data.error == false) {
              this.city = response.data.cities;
            }
          });
      }
    },
    changeCity() {
      if (typeof this.model.city.id === 'undefined') {
        this.model.district = "";
      } else {
        // this.model.district = "";

        axios.get('api/wilayah-indonesia/district/get/by-city/'+this.model.city.id)
          .then(response => {
            if (response.data.status == true && response.data.error == false) {
              this.district = response.data.districts;
            }
          });
      }
    },
    changeDistrict() {
      if (typeof this.model.district.id === 'undefined') {
        this.model.village = "";
      } else {
        // this.model.village = "";

        axios.get('api/wilayah-indonesia/village/get/by-district/'+this.model.district.id)
          .then(response => {
            if (response.data.status == true && response.data.error == false) {
              this.village = response.data.villages;
            }
          });
      }
    },
    reset() {
      axios.get('api/sekolah/' + this.$route.params.id + '/edit')
        .then(response => {
          if (response.data.status == true) {
          this.model.nama           = response.data.sekolah.nama;
          this.model.old_user_id    = response.data.sekolah.user_id;
        //  this.model.user           = response.data.sekolah.user.name;
          this.model.jenis_sekolah  = response.data.sekolah.jenis_sekolah.jenis_sekolah;
          this.model.npsn           = response.data.sekolah.npsn;
          this.model.old_npsn       = response.data.sekolah.npsn;
          this.model.alamat         = response.data.sekolah.alamat;
          this.model.logo           = response.data.sekolah.logo;
          this.model.foto_gedung    = response.data.sekolah.foto_gedung;
          this.model.province       = response.data.sekolah.province;
          this.model.city           = response.data.sekolah.city;
          this.model.district       = response.data.sekolah.district;
          this.model.village        = response.data.sekolah.village;
          this.model.no_telp        = response.data.sekolah.no_telp;
          this.model.email          = response.data.sekolah.email;
          this.model.kode_zona      = response.data.sekolah.master_zona.label;
          } else {
            alert('Failed');
          }
        })
        .catch(function(response) {
          alert('Break ');
        });
    },
    back() {
      window.location = '#/admin/sekolah';
    }
  }
}
</script>
