<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card card-default">
          <div class="card-header">Example Component</div>

          <div class="card-body">
            <pre>{{JSON.stringify(user, null, 2)}}</pre>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  async mounted() {
    const response = await axios.get("/api/user");
    this.user = response.data;
  },
  data() {
    return {
      user: {}
    };
  }
};
</script>
