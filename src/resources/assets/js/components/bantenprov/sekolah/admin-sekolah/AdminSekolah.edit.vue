<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> {{ title }}

      <div class="btn-group pull-right" role="group" style="display:flex;">
        <button class="btn btn-primary btn-sm" role="button" @click="createRow">
          <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
        <button class="btn btn-info btn-sm" role="button" @click="viewRow">
          <i class="fa fa-eye" aria-hidden="true"></i>
        </button>
        <button class="btn btn-danger btn-sm" role="button" @click="deleteRow">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
        <button class="btn btn-default btn-sm" role="button" @click="back">
          <i class="fa fa-arrow-left" aria-hidden="true"></i>
        </button>
      </div>
    </div>

    <div class="card-body">
      <vue-form class="form-horizontal form-validation" :state="state" @submit.prevent="onSubmit">
        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="sekolah_id">Sekolah</label>
              <v-select name="sekolah_id" v-model="model.sekolah" :options="sekolah" placeholder="Sekolah" required autofocus></v-select>

              <field-messages name="sekolah_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Sekolah is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="admin_sekolah_id">Admin Sekolah</label>
              <v-select name="admin_sekolah_id" v-model="model.admin_sekolah" :options="user" placeholder="Admin Sekolah" required></v-select>

              <field-messages name="admin_sekolah_id" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Admin Sekolah is a required field</small>
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
  data() {
    return {
      state: {},
      title: 'Edit Admin Sekolah',
      model: {
        sekolah_id          : '',
        admin_sekolah_id    : '',
        user_id             : '',
        created_at          : '',
        updated_at          : '',

        sekolah             : '',
        admin_sekolah       : '',
        user                : '',
      },
      sekolah           : [],
      admin_sekolah     : [],
      user              : [],
    }
  },
  mounted(){
    let app = this;

    axios.get('api/admin-sekolah/'+this.$route.params.id+'/edit')
      .then(response => {
        if (response.data.status == true && response.data.error == false) {
          this.model.sekolah_id           = response.data.admin_sekolah.sekolah_id;
          this.model.admin_sekolah_id     = response.data.admin_sekolah.admin_sekolah_id;
          this.model.user_id              = response.data.admin_sekolah.user_id;
          this.model.created_at           = response.data.admin_sekolah.created_at;
          this.model.updated_at           = response.data.admin_sekolah.updated_at;

          this.model.sekolah              = response.data.admin_sekolah.sekolah;
          this.model.admin_sekolah        = response.data.admin_sekolah.admin_sekolah;
          this.model.user                 = response.data.admin_sekolah.user;

          if (response.data.admin_sekolah.user === null) {
            this.model.user = response.data.current_user;
          } else {
            this.model.user = response.data.admin_sekolah.user;
          }

          if (response.data.user_special == true) {
            this.user = response.data.users;
          } else {
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

    axios.get('api/sekolah/get')
      .then(response => {
        if (response.data.status == true && response.data.error == false) {
          response.data.sekolahs.forEach(element => {
            this.sekolah.push(element);
          });
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
    onSubmit: function() {
      let app = this;

      if (this.state.$invalid) {
        return;
      } else {
        axios.put('api/admin-sekolah/'+this.$route.params.id, {
            sekolah_id          : this.model.sekolah.id,
            admin_sekolah_id    : this.model.admin_sekolah.id,
            user_id             : this.model.user.id,
          })
          .then(response => {
            if (response.data.status == true) {
              if (response.data.error == false) {
                swal(
                  'Updated',
                  'Yeah!!! Your data has been updated.',
                  'success'
                );

                app.back();
              } else {
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
    reset() {
      this.model = {
        sekolah_id          : '',
        admin_sekolah_id : '',
        created_at          : '',
        updated_at          : '',

        sekolah             : '',
        admin_sekolah       : '',
        user                : '',
      };
    },
    createRow() {
      window.location = '#/admin/admin-sekolah/create';
    },
    viewRow() {
      window.location = '#/admin/admin-sekolah/'+this.$route.params.id;
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
