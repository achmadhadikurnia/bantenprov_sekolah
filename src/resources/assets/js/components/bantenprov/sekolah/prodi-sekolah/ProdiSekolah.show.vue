<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> {{ title }}

      <div class="btn-group pull-right" role="group" style="display:flex;">
        <button class="btn btn-warning btn-sm" role="button" @click="edit">
          <i class="fa fa-pencil" aria-hidden="true"></i>
        </button>
        <button class="btn btn-primary btn-sm" role="button" @click="back">
          <i class="fa fa-arrow-left" aria-hidden="true"></i>
        </button>
      </div>
    </div>

    <div class="card-body">
      <dl class="row">
          <dt class="col-4">NPSN</dt>
          <dd class="col-8">{{ model.sekolah.id }}</dd>

          <dt class="col-4">Nama Sekolah</dt>
          <dd class="col-8">{{ model.sekolah.nama }}</dd>

          <dt class="col-4">Program Keahlian</dt>
          <dd class="col-8">{{ model.program_keahlian.label }}</dd>

          <dt class="col-4">Kuota Siswa</dt>
          <dd class="col-8">{{ model.kuota_siswa }}</dd>
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
      title: 'View Prodi Sekolah',
      model: {
        sekolah_id          : '',
        program_keahlian_id : '',
        kuota_siswa         : '',
        keterangan          : '',
        user_id             : '',

        sekolah             : [],
        program_keahlian    : [],
        user                : [],
      },
    }
  },
  mounted() {
    let app = this;

    axios.get('api/prodi-sekolah/' + this.$route.params.id)
      .then(response => {
        if (response.data.status == true && response.data.error == false) {
          this.model.sekolah_id           = response.data.prodi_sekolah.sekolah_id;
          this.model.program_keahlian_id  = response.data.prodi_sekolah.program_keahlian_id;
          this.model.kuota_siswa          = response.data.prodi_sekolah.kuota_siswa;
          this.model.keterangan           = response.data.prodi_sekolah.keterangan;
          this.model.user_id              = response.data.prodi_sekolah.user_id;
          this.model.created_at           = response.data.prodi_sekolah.created_at;
          this.model.updated_at           = response.data.prodi_sekolah.updated_at;

          this.model.sekolah              = response.data.prodi_sekolah.sekolah;
          this.model.program_keahlian     = response.data.prodi_sekolah.program_keahlian;
          this.model.user                 = response.data.prodi_sekolah.user;

          if (this.model.sekolah === null) {
            this.model.sekolah = {
              'id'    :this.model.sekolah_id,
              'nama'  :''
            };
          }

          if (this.model.program_keahlian === null) {
            this.model.program_keahlian = {
              'id'    :this.model.program_keahlian_id,
              'label' :''
            };
          }

          if (this.model.user === null) {
            this.model.user = {
              'id'    :this.model.user_id,
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
    edit() {
      window.location = '#/admin/prodi-sekolah/'+this.$route.params.id+'/edit';
    },
    back() {
      window.location = '#/admin/prodi-sekolah';
    }
  }
}
</script>