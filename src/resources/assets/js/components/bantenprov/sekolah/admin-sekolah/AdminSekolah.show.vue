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
          <dt class="col-4">NPSN</dt>
          <dd class="col-8">{{ model.sekolah.id }}</dd>

          <dt class="col-4">Nama Sekolah</dt>
          <dd class="col-8">{{ model.sekolah.nama }}</dd>

          <dt class="col-4">Admin Sekolah</dt>
          <dd class="col-8">{{ model.admin_sekolah.name }}</dd>

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
      title: 'View Admin Sekolah',
      model: {

        sekolah_id          : '',
        admin_sekolah_id    : '',
        user_id             : '',

        sekolah             : [],
        admin_sekolah       : [],
        user                : [],
      },
    }
  },
  mounted() {
    let app = this;

    axios.get('api/admin-sekolah/' + this.$route.params.id)
      .then(response => {
        if (response.data.status == true && response.data.error == false) {
          this.model.sekolah_id           = response.data.admin_sekolah.sekolah_id;
          this.model.admin_sekolah_id  = response.data.admin_sekolah.admin_sekolah_id;
          this.model.user_id              = response.data.admin_sekolah.user_id;
          this.model.created_at           = response.data.admin_sekolah.created_at;
          this.model.updated_at           = response.data.admin_sekolah.updated_at;

          this.model.sekolah              = response.data.admin_sekolah.sekolah;
          this.model.admin_sekolah        = response.data.admin_sekolah.admin_sekolah;
          this.model.user                 = response.data.admin_sekolah.user;

          if (this.model.sekolah === null) {
            this.model.sekolah = {
              'id'    :this.model.sekolah_id,
              'nama'  :''
            };
          }

          if (this.model.admin_sekolah === null) {
            this.model.admin_sekolah = {
              'id'    :this.model.admin_sekolah_id,
              'name' :''
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
    createRow() {
      window.location = '#/admin/admin-sekolah/create';
    },
    editRow() {
      window.location = '#/admin/admin-sekolah/'+this.$route.params.id+'/edit';
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
          axios.delete('/api/admin-sekolah/'+this.$route.params.id)
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
      window.location = '#/admin/admin-sekolah';
    }
  }
}
</script>