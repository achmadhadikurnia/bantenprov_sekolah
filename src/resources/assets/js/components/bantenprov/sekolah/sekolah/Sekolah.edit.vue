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
              <label for="label">Nama Sekolah</label>
              <input class="form-control" v-model="model.label" required autofocus name="label" type="text" placeholder="Nama Sekolah">

              <field-messages name="label" show="$invalid && $submitted" class="text-danger">
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

        <div class="form-row mt-4">
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
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="province_id">Provinsi</label>
              <input class="form-control" v-model="model.province_id" name="province_id" type="text" placeholder="Provinsi">

              <field-messages name="province_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="city_id">Kota/Kabupaten</label>
              <input class="form-control" v-model="model.city_id" name="city_id" type="text" placeholder="Kota/Kabupaten">

              <field-messages name="city_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="district_id">Kecamatan</label>
              <input class="form-control" v-model="model.district_id" name="district_id" type="text" placeholder="Kecamatan">

              <field-messages name="district_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="village_id">Kelurahan</label>
              <input class="form-control" v-model="model.village_id" name="village_id" type="text" placeholder="Kelurahan">

              <field-messages name="village_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
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
              <label for="kode_zona">Zona</label>
              <input class="form-control" v-model="model.kode_zona" name="kode_zona" type="text" placeholder="Zona">

              <field-messages name="kode_zona" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
            <label for="jenis_sekolah">Jenis Sekolah</label>
            <v-select name="jenis_sekolah" v-model="model.jenis_sekolah" :options="jenis_sekolah" class="mb-4"></v-select>

            <field-messages name="jenis_sekolah" show="$invalid && $submitted" class="text-danger">
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
export default {
  mounted() {
    axios.get('api/sekolah/' + this.$route.params.id + '/edit')
      .then(response => {
        if (response.data.status == true) {

          this.model.label          = response.data.sekolah.label;
          this.model.old_user_id    = response.data.sekolah.user_id;
          this.model.user           = response.data.user;
          this.model.jenis_sekolah  = response.data.jenis_sekolah;
          this.model.npsn           = response.data.sekolah.npsn;
          this.model.old_npsn       = response.data.sekolah.npsn;
          this.model.alamat         = response.data.sekolah.alamat;
          this.model.logo           = response.data.sekolah.logo;
          this.model.foto_gedung    = response.data.sekolah.foto_gedung;
          this.model.province_id    = response.data.sekolah.province_id;
          this.model.city_id        = response.data.sekolah.city_id;
          this.model.district_id    = response.data.sekolah.district_id;
          this.model.village_id     = response.data.sekolah.village_id;
          this.model.no_telp        = response.data.sekolah.no_telp;
          this.model.email          = response.data.sekolah.email;
          this.model.kode_zona        = response.data.sekolah.kode_zona;

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
          response.data.jenis_sekolah.forEach(element => {
            this.jenis_sekolah.push(element);
          });
          if(response.data.user_special == true){
            response.data.user.forEach(user_element => {
              this.user.push(user_element);
            });
          }else{
            this.user.push(response.data.user);
          }
      })
      .catch(function(response) {
        alert('Break');
        window.location.href = '#/admin/sekolah';
      })
  },
  data() {
    return {
      state: {},
      model: {
        label:          "",
        user:           "",
        jenis_sekolah:  "",
        npsn:           "",
        alamat:         "",
        logo:           "",
        foto_gedung:    "",
        province_id: "",
        city_id: "",
        district_id: "",
        village_id: "",
        no_telp: "",
        email: "",
        kode_zona: "",
        old_user_id:    "",
        old_npsn:       "",
      },
      jenis_sekolah: [],
      user: []
    }
  },
  methods: {
    onSubmit: function() {
      let app = this;

      if (this.state.$invalid) {
        return;
      } else {
        axios.put('api/sekolah/' + this.$route.params.id, {
            label:              this.model.label,
            user_id:            this.model.user.id,
            old_user_id:        this.model.old_user_id,
            jenis_sekolah_id:   this.model.jenis_sekolah.id,
            npsn:               this.model.npsn,
            old_npsn:           this.model.old_npsn,
            alamat:             this.model.alamat,
            logo:               this.model.logo,
            foto_gedung:        this.model.foto_gedung,
            province_id:        this.model.province_id,
            city_id:            this.model.city_id,
            district_id:        this.model.district_id,
            village_id:         this.model.village_id,
            no_telp:            this.model.no_telp,
            email:              this.model.email,
            kode_zona:            this.model.kode_zona,
          })
          .then(response => {
            if (response.data.status == true) {
              if(response.data.message == 'success'){
                alert(response.data.message);
                app.back();
              }else{
                alert(response.data.message);
              }
            } else {
              alert(response.data.message);
            }
          })
          .catch(function(response) {
            alert('Break ' + response.data.message);
          });
      }
    },
    reset() {
      axios.get('api/sekolah/' + this.$route.params.id + '/edit')
        .then(response => {
          if (response.data.status == true) {
            this.model.label          = response.data.sekolah.label;
            this.model.user           = response.data.sekolah.user;
            this.model.jenis_sekolah  = response.data.sekolah.jenis_sekolah.jenis_sekolah;
            this.model.npsn           = response.data.sekolah.npsn;
            this.model.alamat         = response.data.sekolah.alamat;
            this.model.logo           = response.data.sekolah.logo;
            this.model.foto_gedung    = response.data.sekolah.foto_gedung;
            this.model.province_id    = response.data.sekolah.province_id;
          this.model.city_id        = response.data.sekolah.city_id;
          this.model.district_id    = response.data.sekolah.district_id;
          this.model.village_id     = response.data.sekolah.village_id;
          this.model.no_telp        = response.data.sekolah.no_telp;
          this.model.email          = response.data.sekolah.email;
          this.model.kode_zona        = response.data.sekolah.kode_zona;
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
