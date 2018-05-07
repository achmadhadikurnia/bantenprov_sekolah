<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> {{ title }}

      <div class="btn-group pull-right" role="group" style="display:flex;">
        <button class="btn btn-primary btn-sm" role="button" @click="createRow">
          <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
        <button class="btn btn-warning btn-sm" role="button" @click="editRow">
          <i class="fa fa-pencil" aria-hidden="true"></i>
        </button>
        <button class="btn btn-danger btn-sm" role="button" @click="deleteRow">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
        <button class="btn btn-primary btn-sm" role="button" @click="back">
          <i class="fa fa-arrow-left" aria-hidden="true"></i>
        </button>
      </div>
    </div>

    <div class="card-body">
      <dl class="row">
          <dt class="col-4">Nama</dt>
          <dd class="col-8">{{ model.nama }}</dd>

          <dt class="col-4">NPSN</dt>
          <dd class="col-8">{{ model.npsn }}</dd>

          <dt class="col-4">Jenis Sekolah</dt>
          <dd class="col-8">{{ model.jenis_sekolah.jenis_sekolah }}</dd>

          <dt class="col-4">Alamat</dt>
          <dd class="col-8">{{ model.alamat }}</dd>

          <!-- <dt class="col-4">Logo</dt>
          <dd class="col-8">{{ model.logo }}</dd> -->

          <!-- <dt class="col-4">Foto Gedung</dt>
          <dd class="col-8">{{ model.foto_gedung }}</dd> -->

          <dt class="col-4">Provinsi</dt>
          <dd class="col-8">{{ model.province.name }}</dd>

          <dt class="col-4">Kabupaten/Kota</dt>
          <dd class="col-8">{{ model.city.name }}</dd>

          <dt class="col-4">Kecamatan</dt>
          <dd class="col-8">{{ model.district.name }}</dd>

          <dt class="col-4">Kelurahan/Desa</dt>
          <dd class="col-8">{{ model.village.name }}</dd>

          <dt class="col-4">No Telepon</dt>
          <dd class="col-8">{{ model.no_telp }}</dd>

          <dt class="col-4">Email</dt>
          <dd class="col-8">{{ model.email }}</dd>

          <dt class="col-4">Zona</dt>
          <dd class="col-8">{{ model.master_zona.label }}</dd>

          <dt class="col-4">UUID</dt>
          <dd class="col-8">{{ model.uuid }}</dd>
      </dl>
    </div>

    <div class="card-footer text-muted">
      <div class="row">
        <div class="col-md">
          <b>Username :</b> {{ model.user.name }}
        </div>
        <div class="col-md">
          <div class="col-md text-right">Dibuat : {{ model.created_at }}</div>
          <div class="col-md text-right">Diperbarui : {{ model.updated_at }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import swal from 'sweetalert2';

export default {
  data() {
    return {
      state: {},
      title: 'View Sekolah',
      model: {
        nama              : '',
        npsn              : '',
        jenis_sekolah_id  : '',
        alamat            : '',
        logo              : '',
        foto_gedung       : '',
        province_id       : '',
        city_id           : '',
        district_id       : '',
        village_id        : '',
        no_telp           : '',
        email             : '',
        kode_zona         : '',
        uuid              : '',
        user_id           : '',

        jenis_sekolah     : [],
        province          : [],
        city              : [],
        district          : [],
        village           : [],
        master_zona       : [],
        user              : [],
      },
    }
  },
  mounted() {
    let app = this;

    axios.get('api/sekolah/' + this.$route.params.id)
      .then(response => {
        if (response.data.status == true && response.data.error == false) {
          this.model.nama             = response.data.sekolah.nama;
          this.model.npsn             = response.data.sekolah.npsn;
          this.model.jenis_sekolah_id = response.data.sekolah.jenis_sekolah_id;
          this.model.alamat           = response.data.sekolah.alamat;
          this.model.logo             = response.data.sekolah.logo;
          this.model.foto_gedung      = response.data.sekolah.foto_gedung;
          this.model.province_id      = response.data.sekolah.province_id;
          this.model.city_id          = response.data.sekolah.city_id;
          this.model.district_id      = response.data.sekolah.district_id;
          this.model.village_id       = response.data.sekolah.village_id;
          this.model.no_telp          = response.data.sekolah.no_telp;
          this.model.email            = response.data.sekolah.email;
          this.model.kode_zona        = response.data.sekolah.kode_zona;
          this.model.uuid             = response.data.sekolah.uuid;
          this.model.user_id          = response.data.sekolah.user_id;
          this.model.created_at       = response.data.sekolah.created_at;
          this.model.updated_at       = response.data.sekolah.updated_at;

          this.model.jenis_sekolah    = response.data.sekolah.jenis_sekolah;
          this.model.province         = response.data.sekolah.province;
          this.model.city             = response.data.sekolah.city;
          this.model.district         = response.data.sekolah.district;
          this.model.village          = response.data.sekolah.village;
          this.model.master_zona      = response.data.sekolah.master_zona;
          this.model.user             = response.data.sekolah.user;

          if (this.model.jenis_sekolah === null) {
            this.model.jenis_sekolah = {
              'id'            : this.model.jenis_sekolah_id,
              'jenis_sekolah' :''
            };
          }

          if (this.model.province === null) {
            this.model.province = {
              'id'    : this.model.province_id,
              'name'  :''
            };
          }

          if (this.model.city === null) {
            this.model.city = {
              'id'    : this.model.city_id,
              'name'  :''
            };
          }

          if (this.model.district === null) {
            this.model.district = {
              'id'    : this.model.district_id,
              'name'  :''
            };
          }

          if (this.model.village === null) {
            this.model.village = {
              'id'    : this.model.village_id,
              'name'  :''
            };
          }

          if (this.model.master_zona === null) {
            this.model.master_zona = {
              'id'    : this.model.kode_zona,
              'label' :''
            };
          }

          if (this.model.user === null) {
            this.model.user = {
              'id'    : this.model.user_id,
              'name'  :''
            };
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
  },
  methods: {
    createRow() {
      window.location = '#/admin/sekolah/create';
    },
    editRow() {
      window.location = '#/admin/sekolah/'+this.$route.params.id+'/edit';
    },
    deleteRow() {
      let app = this;

      swal({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          axios.delete('/api/sekolah/'+this.$route.params.id)
            .then(function(response) {
              if (response.data.status == true) {
                app.back();

                swal(
                  'Deleted',
                  'Yeah!!! Your data has been deleted.',
                  'success'
                );
              } else {
                swal(
                  'Failed',
                  'Oops... Failed to delete data.',
                  'error'
                );
              }
            })
            .catch(function(response) {
              swal(
                'Not Found',
                'Oops... Your page is not found.',
                'error'
              );
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
          swal(
            'Cancelled',
            'Your data is safe.',
            'error'
          );
        }
      });
    },
    back() {
      window.location = '#/admin/sekolah';
    }
  }
}
</script>