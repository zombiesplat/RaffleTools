Vue.component('item-edit', {
    props: ['item_id'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new SparkForm({
                event_id: "",
                type: "",
                name: "",
                description: "",
                image: "",
                image_src: "",
                value: "",
                cost: "",
                sponsor: "",
                contact_phone: "",
                open_date_time: "",
                drawing_date_time: "",
                terms_and_conditions: "",
            }),
            dataLoaded: false,
            dropzone: null,
        };
    },

    created: function () {
        let self = this;
        Bus.$on('attachment_uploaded', function (all_errors) {
        });
    },

    /**
     * Prepare the component.
     */
    mounted() {
        this.$nextTick(function(){
            this.getItem();
        });
        let previewTemplate = `
        <div>
            <div>
                UPLOADING: <span data-dz-name></span> <span data-dz-size></span>
                <strong class="error text-danger" data-dz-errormessage></strong>
            </div>
            <div class="file-attachment-upload-progress-container">
                <div class="file-attachment-upload-progress" style="width: 0%" data-dz-uploadprogress></div>
            </div>
            <div>
                <br>
                <button data-dz-remove class="btn dme-btn-primary">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            </div>
        </div>
        `;

        let self = this;
        this.dropzone = new Dropzone("#dmedropzone", {
            maxFiles: 1,
            url: `/api/item/${this.item_id}/image`, // Set the url
            headers: {
                "X-CSRF-TOKEN": Spark.csrfToken,
                "X-XSRF-TOKEN": Cookies.get('XSRF-TOKEN'),
            },
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            previewsContainer: "#previews", // Define the container to display the previews
        });
        document.querySelector("#total-progress").style.opacity = "0";

        this.dropzone.on('success', function (file, response) {
            self.form.image = response.image;
            self.form.image_src = response.image_src;
            self.dropzone.removeFile(file);
        });

        // Update the total progress bar
        this.dropzone.on("totaluploadprogress", function (progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
        });

        // Hide the total progress bar when nothing's uploading anymore
        this.dropzone.on("queuecomplete", function (progress) {
            document.querySelector("#total-progress").style.opacity = "0";
        });

        this.dropzone.on("sending", function (file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1";
        });

        this.dropzone.on("error", function (file, response, xhr) {
            // display the error
            let message = 'An error occurred during upload';
            if (typeof response === "string") {
                message = xhr.statusText;
            } else if (typeof response.file !== "undefined") {
                message = response.file.join(", ");
            }
            file.previewElement.classList.add("dz-error");
            _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i];
                _results.push(node.textContent = message);
            }
            return _results;
        });
    },

    methods: {
        getItem() {
            if (!this.form.busy) {
                this.dataLoaded = false;
                this.form.startProcessing();
                axios.get('/api/item/' + this.item_id)
                    .then(response => {
                        this.form.finishProcessing();
                        this.dataLoaded = true;
                        item = response.data;
                        this.form.event_id = item.event_id;
                        this.form.type = item.type;
                        this.form.name = item.name;
                        this.form.description = item.description;
                        this.form.image = item.image;
                        this.form.image_src = item.image_src;
                        this.form.value = item.value;
                        this.form.cost = item.cost;
                        this.form.sponsor = item.sponsor;
                    });
            }
        },
        saveForm() {
            if (!this.form.busy) {
                this.form.startProcessing();
                axios.put('/api/item/' + this.item_id, this.form)
                    .then(response => {
                        this.form.finishProcessing();
                        window.location.href = '/event/'+this.form.event_id+'/items';
                    },
                    error => {
                        this.form.setErrors(error.response.data);
                    });
            }
        },
        removeImage() {
            this.form.image = '';
            this.form.image_src = '';
        },
        bytesToSize: function (bytes, decimals = 2, binaryUnits = true) {
            if(bytes == 0) {
                return '0 Bytes';
            }
            let unitMultiple = (binaryUnits) ? 1024 : 1000;
            let unitNames = (unitMultiple === 1024) ? // 1000 bytes in 1 Kilobyte (KB) or 1024 bytes for the binary version (KiB)
                ['Bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB']:
                ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
            let unitChanges = Math.floor(Math.log(bytes) / Math.log(unitMultiple));
            return parseFloat((bytes / Math.pow(unitMultiple, unitChanges)).toFixed(decimals || 0)) + ' ' + unitNames[unitChanges];
        },
        removeDocument(document) {
            var self = this;
            this.form.startProcessing();
            this.axios.delete(`/api/item/${this.item_id}/image`)
                .then(
                    (response) => {
                        if (response.data.success) {
                            the_index = false;
                            for (var idx in self.documents) {
                                tmp_doc = self.documents[idx];
                                if (tmp_doc.id == document.id) {
                                    the_index = idx;
                                }
                            }
                            if (the_index !== false) {
                                self.documents.splice(the_index, 1);
                            }
                        }
                        // update view variables here.. either get them back from the request fire off a new request.
                        self.form.finishProcessing();
                    },
                    (response) => {
                        self.form.setErrors(response.data.responseJSON);
                    }
                );
        },
    }

});
