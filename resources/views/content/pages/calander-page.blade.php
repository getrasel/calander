@extends('layouts/contentNavbarLayout')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- dragging  -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

 <!-- Flatpickr JS -->
 <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
  <!-- dragging  -->
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" defer></script> --}}

 <script>
     document.addEventListener("DOMContentLoaded", () => {
         flatpickr("#datepicker", {
             dateFormat: "Y-m-d",
         });
     });
     document.addEventListener("DOMContentLoaded", () => {
         flatpickr("#modaldate", {
             dateFormat: "Y-m-d",
         });
     });
     document.addEventListener("DOMContentLoaded", () => {
         flatpickr("#startdate", {
             dateFormat: "Y-m-d",
         });
     });
 </script>
 <script>  
 // dragging 

  // $(document).ready(function(){
  //   $("#sortable").sortable({
  //     handle: ".timesitem",  // Drag only by the .item_drag element
  //     placeholder: "ui-state-highlight",
  //     update: function(event, ui) {
  //       console.log("New order:", $("#sortable").sortable("toArray"));
  //     }
  //   });
  //   $("#sortable").disableSelection();
  // });

  // jQuery menu code
  $(document).ready(function() {
      $('#menubar').click(function() {
          $('#slideMenu').toggleClass('slidin');
          $('#maindate').toggleClass('blacky');
          $('#crossicon').toggleClass('cross');
          $('#menuIcon').toggleClass('bar');
      });
      $('#maindate').click(function() {
          $('#slideMenu').removeClass('slidin');
      });
  });

  // collapse for item
  // document.addEventListener('click', function(event) {
    // const collapse = document.getElementById('Item');
    // const button = document.querySelector('.add_another_item');
    
    // if (!collapse.contains(event.target) && !button.contains(event.target)) {
    //   const bsCollapse = bootstrap.Collapse.getInstance(collapse);
    //   if (bsCollapse) {
    //     bsCollapse.hide();
    //   }
    // }
  // });
</script>


<script> 
  document.addEventListener("DOMContentLoaded", () => {
    const container = document.getElementById("dragging");

    if (!container) {
      console.error("Container with id 'dragging' not found.");
      return;
    }

    const items = container.querySelectorAll(".timesitem");

    if (items.length === 0) {
      console.error("No elements with class 'timesitem' found.");
      return;
    }

    items.forEach(item => {
      item.addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("text/plain", e.target.id); // Store the ID of the dragged element
        e.target.classList.add("dragging");
      });

      item.addEventListener("dragend", (e) => {
        e.target.classList.remove("dragging");
      });
    });

    container.addEventListener("dragover", (e) => {
      e.preventDefault();
      const afterElement = getDragAfterElement(container, e.clientY);
      const draggable = document.querySelector(".dragging");

      if (draggable) {
        if (afterElement == null) {
          container.appendChild(draggable);
        } else {
          container.insertBefore(draggable, afterElement);
        }
      }
    });

    function getDragAfterElement(container, y) {
      const draggableElements = [...container.querySelectorAll(".timesitem:not(.dragging)")];

      return draggableElements.reduce((closest, child) => {
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;
        if (offset < 0 && offset > closest.offset) {
          return { offset: offset, element: child };
        } else {
          return closest;
        }
      }, { offset: Number.NEGATIVE_INFINITY }).element;
    }
  });

</script>


@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="calander_section">
      <div class="calander_top">
        <div class="filter_area">
          <div class="dropdown dr_one">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              View options
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><div class="flexname">View by users</div> <div class="check"><i class="fas fa-check"></i></div></a></li>
              <li><a class="dropdown-item" href="#">View by jobs <div class="btn btnjob" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Learn More">
                <i class="far fa-circle-question"></i>
              </div></a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item listview" href="#"><i class="fa-solid fa-list"></i> List view</a></li>
              <li><hr class="dropdown-divider"></li>
              <li class="drinside">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="flexname">Sort shift</div> <div class="check"><i class="fas fa-angle-right"></i></div>
                </button>
                <ul class="dropdown-menu dropend">
                  <li><a class="dropdown-item" href="#"><div class="flexname">Sort by time</div> <div class="check"><i class="fas fa-check"></i></div></a></li>
                  <li><a class="dropdown-item listview" href="#"> Sort by job's name</a></li>
                  <li><a class="dropdown-item listview" href="#"> Sort by shit title</a></li>
                </ul>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <div class="form-check form-switch">
                  <label class="form-check-label" for="flexSwitchCheckChecked">Minimized view</label>
                  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                </div>
              </li>
              <li>
                <div class="form-check form-switch">
                  <label class="form-check-label" for="flexSwitchCheckChecked2">Availability status</label>
                  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked2" checked>
                </div>
              </li>
            </ul>
          </div>
          <div class="dropdown dr_two">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-sort-amount-down-alt"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Day</a></li>
              <li><a class="dropdown-item" href="#">Week</a></li>
              <li><a class="dropdown-item" href="#">Month</a></li>
            </ul>
          </div>
          <div class="dropdown dr_three">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Week
            </button>
            <ul class="dropdown-menu fit_content">
              <li><a class="dropdown-item" href="#">Day</a></li>
              <li><a class="dropdown-item" href="#">Week</a></li>
              <li><a class="dropdown-item" href="#">Month</a></li>
            </ul>
          </div>
          <div class="dropdown dr_four">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="past_month"><i class="fas fa-chevron-left"></i></div>
              <div class="datepick" id="datepicker">Dec 16-22</div>
              <div class="next_month"><i class="fas fa-chevron-right"></i></div>
            </button>
          </div>
          <button type="button" class="btn dr_five"
                  data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-custom-class="custom-tooltip"
                  data-bs-title="Show Today">
                  <i class="fas fa-calendar-day"></i>
          </button>
        </div>
        <div class="button_area">
          <div class="dropdown dr_six">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Actions
            </button>
            <ul class="dropdown-menu">
              <li><span class="titlesmall">Weeks Actions</span></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-eye-slash"></i></div> Unpublish week</a></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-user-slash"></i></div> Unassign week</a></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-file-export"></i></div> Export week</a></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-print"></i></div> print week</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><span class="titlesmall">Template</span></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
              <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
            </ul>
          </div>
          <div class="dropdown dr_seven">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Add
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Add single shift</a></li>
              <li><a class="dropdown-item" href="#">Add multiple shifts</a></li>
              <li><a class="dropdown-item" href="#">Import shifts sfrom Excel</a></li>
              <li><a class="dropdown-item" href="#">Add from shift templates</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Add unavailability</a></li>
              <li><a class="dropdown-item" href="#">Add time off</a></li>
            </ul>
          </div>
          <div class="dropdown dr_eight">
            <button class="btn dropdown-toggle" type="button" disabled data-bs-toggle="dropdown" aria-expanded="false">
              Publish
            </button>
          </div>
        </div>
      </div>
      {{-- end top area  --}}
      {{-- modal  --}}
      <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasRightLabel">Tuesday, Dec 17, 2024</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
          <div class="offcanvas-body">
            <ul class="nav nav-tabs" 
            id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" 
                    id="shiftdetail-tab" 
                    data-bs-toggle="tab" data-bs-target="#shiftdetail" 
                    type="button" role="tab" 
                    aria-controls="shiftdetail" aria-selected="true"><i class="far fa-file-alt"></i> Shift details
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" 
                    id="template-tab" 
                    data-bs-toggle="tab" data-bs-target="#template" 
                    type="button" role="tab" 
                    aria-controls="template" aria-selected="false"><i class="far fa-bell"></i> Shift tasks
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" 
                    id="tasks-tab" 
                    data-bs-toggle="tab" data-bs-target="#tasks" 
                    type="button" role="tab" 
                    aria-controls="tasks" aria-selected="false"><i class="fas fa-link"></i> Templates
            </button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="shiftdetail" 
              role="tabpanel" aria-labelledby="shiftdetail-tab">
            <div class="shift_ditail">
              <div class="date_shift">
                <div class="date_item">
                  <i class="fas fa-calendar-alt"></i>
                  <span>Date</span>
                </div>
                <div class="date_item">
                  <button type="button" class="btn" id="modaldate">
                    12/17/2024 <i class="fas fa-caret-down"></i>
                  </button>
                </div>
                <div class="date_item">
                  <span>All day</span>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                  </div>
                </div>
              </div>
              <div class="date_shift">
                <div class="date_item">
                  <div class="start">
                    <i class="far fa-clock"></i>
                    <span>Start</span>
                  </div>
                  <div class="startend">
                    <input type="text" name="timefrom" class="form-control" value="9:00">
                    <div class="ampm">
                      <p>am</p>
                      <p class="active">pm</p>
                    </div>
                  </div>
                  <div class="startend">
                    <input type="text" name="timefrom" class="form-control" value="01:00">
                    <div class="ampm">
                      <p>am</p>
                      <p class="active">pm</p>
                    </div>
                  </div>
                </div>
                <div class="date_item">
                  <p>08:00 Hours</p>
                </div>
              </div>
              <div class="btn_shift">
                <a href="#"><i class="fa-solid fa-cart-plus"></i> Add break</a>
                <a href="#"><i class="fa-solid fa-repeat"></i> Does not repeat</a>
                <a href="#"><i class="fa-solid fa-globe"></i> America/New_York <span data-bs-toggle="tooltip" data-bs-title="Learn More"><i class="fa-solid fa-question"></i></span></a>
              </div>
              <div class="form_shift">
                {{-- <div class="form_group">
                  <div class="titleinput"><p>Shift title</p></div>
                  <div class="forminput"><input type="text" class="form-control" placeholder="Type here"></div>
                </div> --}}
                <div class="form_group">
                  <div class="titleinput"><p>Client Name</p></div>
                  <div class="forminput">
                    <div class="forminput"><input type="text" class="form-control" placeholder="Type here" value="Sharah Smith"></div>
                    <div class="dropdown colormenu">
                      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="selected_color"></div>
                      </button>
                      <ul class="dropdown-menu colordropdown">
                        <li><a class="dropdown-item" href="#"><div class="maincolor colorone"></div></a></li>
                        <li><a class="dropdown-item" href="#"><div class="maincolor colortwo"></div></a></li>
                        <li><a class="dropdown-item" href="#"><div class="maincolor colorthree"></div></a></li>
                        <li><a class="dropdown-item" href="#"><div class="maincolor colorfour"></div></a></li>
                        <li><a class="dropdown-item" href="#"><div class="maincolor colorfive"></div></a></li>
                        <li><a class="dropdown-item" href="#"><div class="maincolor colorone"></div></a></li>
                        <li><a class="dropdown-item" href="#"><div class="maincolor colortwo"></div></a></li>
                        <li><a class="dropdown-item" href="#"><div class="maincolor colorthree"></div></a></li>
                        <li><a class="dropdown-item" href="#"><div class="maincolor colorfour"></div></a></li>
                        <li><a class="dropdown-item" href="#"><div class="maincolor colorfive"></div></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="form_group flexend relativeflex">
                  <div class="add_another_item" data-bs-toggle="collapse" data-bs-target="#Item" aria-expanded="false" aria-controls="Item">
                    <div class="item_title">
                      <i class="fas fa-plus"></i>
                    <p>Add Another Item</p>
                    </div>
                  </div>
                    <!-- Item -->
                  <div class="collapse item_collapse" id="Item">
                      <div class="accordion accordion-flush" id="itemac">
                        <div class="accordion-item">
                          <div class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                              <div class="jobitem">
                              <i class="fas fa-angle-up"></i>
                              <p>New job</p>
                              </div>
                              <div class="deleteitem"><i class="far fa-trash-alt"></i></div>
                            </button>
                          </div>
                          <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#itemac">
                            <div class="job_item">
                              <div class="item_dr">
                                <p>Service</p>
                                <div class="dropdown">
                                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                    2 Dogs / Initial Clean-Up
                                  </button>
                                  <ul class="dropdown-menu fit_content">
                                    <li><a class="dropdown-item" href="#">2 Dogs / Initial Clean-Up</a></li>
                                    <li><a class="dropdown-item" href="#">1 Dogs / Initial Clean-Up</a></li>
                                    <li><a class="dropdown-item" href="#">3 Dogs / Initial Clean-Up</a></li>
                                  </ul>
                                </div>
                              </div>
                              <div class="item_dr">
                                <p>Service Extras</p>
                                <input type="text" class="form-control" placeholder="Extra Sevice">
                              </div>
                              <div class="flex_item">
                                <div class="item_time">
                                  <p>Clean-up Time</p>
                                  <input type="text" class="form-control" value="10 minutes">
                                </div>
                                <div class="item_time">
                                  <p>Clean-up Time</p>
                                  <input type="text" class="form-control" value="10 minutes">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <div class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                              <div class="jobitem">
                                <i class="fas fa-angle-up"></i>
                                <p>New Booking</p>
                              </div>
                              <div class="deleteitem"><i class="far fa-trash-alt"></i></div>
                            </button>
                          </div>
                          <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#itemac">
                            <div class="booking_area">
                              <div class="item_book">
                                <p>Service</p>
                                <div class="dropdown">
                                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                    <span>Tooth Whitening</span>
                                    <i class="fas fa-angle-down"></i>
                                  </button>
                                  <ul class="dropdown-menu fit_content">
                                    <li><a class="dropdown-item" href="#">One</a></li>
                                    <li><a class="dropdown-item" href="#">Two</a></li>
                                    <li><a class="dropdown-item" href="#">Three</a></li>
                                  </ul>
                                </div>
                              </div>
                              
                              <div class="item_book">
                                <p>Service Extras</p>
                                <input type="text" class="form-control" placeholder="Click here to select...">
                              </div>
                              <div class="item_book">
                                <div class="item_flex">
                                  <div class="item_status">
                                    <p>Agent</p>
                                    <div class="dropdown">
                                      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                        <span>John Mayers</span>
                                        <i class="fas fa-angle-down"></i>
                                      </button>
                                      <ul class="dropdown-menu fit_content">
                                        <li><a class="dropdown-item" href="#">One</a></li>
                                        <li><a class="dropdown-item" href="#">Two</a></li>
                                        <li><a class="dropdown-item" href="#">Three</a></li>
                                      </ul>
                                    </div>
                                  </div>
                                  <div class="item_status">
                                    <p>Status</p>
                                    <div class="dropdown">
                                      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                        <span>Approved</span>
                                        <i class="fas fa-angle-down"></i>
                                      </button>
                                      <ul class="dropdown-menu fit_content">
                                        <li><a class="dropdown-item" href="#">One</a></li>
                                        <li><a class="dropdown-item" href="#">Two</a></li>
                                        <li><a class="dropdown-item" href="#">Three</a></li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="item_book">
                                <div class="item_flex">
                                  <div class="item_status">
                                    <p>Start Date</p>
                                    <input type="text" class="form-control" placeholder="12/25/2025" id="startdate">
                                  </div>
                                  <div class="item_status">
                                    <p>Availability</p>
                                    <button type="button" class="btn available"><span>Availability</span><i class="fas fa-arrow-right"></i></button>
                                  </div>
                                </div>
                              </div>
                              <div class="item_book">
                                <div class="item_flex">
                                  <div class="item_status">
                                    <p>Start Time</p>
                                    <div class="startend">
                                      <input type="text" name="timefrom" class="form-control" value="10:00">
                                      <div class="ampm">
                                        <p class="active">am</p>
                                        <p>pm</p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="item_status">
                                    <p>End Time</p>
                                    <div class="startend">
                                      <input type="text" name="timefrom" class="form-control" value="10:00">
                                      <div class="ampm">
                                        <p class="active">am</p>
                                        <p>pm</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="item_book">
                                <div class="item_flex">
                                  <div class="item_status">
                                    <p>Beffer Before</p>
                                    <input type="text" class="form-control" value="10 minutes">
                                  </div>
                                  <div class="item_status">
                                    <p>Beffer After</p>
                                    <input type="text" class="form-control" value="10 minutes">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>


                  </div>
                </div>
                <div class="form_group userinfo">
                  <div class="titleinput"><p>jobs (s)</p></div>
                  <div class="forminput jobsslide">
                    <div class="item_box">
                      <div class="collapse_box" data-bs-toggle="collapse" data-bs-target="#prcollapses" aria-expanded="false" aria-controls="prcollapses">
                        <div class="img_inside"><img src="{{asset ('/assets/img/provile.webp') }}"></div>
                        <div class="job_content">
                          <i class="fas fa-minus-circle"></i>
                          <h5>2 Dogs / Initial Clean-Up</h5>
                          <span>Today, 10:00am</span>
                        </div>
                      </div>
                    </div>
                    <div class="item_box">
                      <div class="ac_collapse">
                        
                      </div>
                      <div class="collapse_box">
                        <div class="img_inside"><img src="{{asset ('/assets/img/provile.webp') }}"></div>
                        <div class="job_content">
                          <i class="fas fa-minus-circle"></i>
                          <h5>2 Dogs / Initial Clean-Up</h5>
                          <span>Today, 10:00am</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form_group userinfo">
                  <div class="titleinput"><p>Tech (s)</p> <i class="fa-regular fa-circle-question" data-bs-toggle="tooltip" data-bs-title="learn More"></i></div>
                  <div class="forminput">
                    <div class="dropdown flex_btn">
                      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user_btn">Mike Jones <i class="fas fa-times"></i></div>
                        <div class="user_btn"><i class="fas fa-plus"></i> Add users</div>
                        <div class="delete_btn"><i class="far fa-trash-alt" data-bs-toggle="tooltip" data-bs-title="learn More"></i></div>
                      </button>
                      <ul class="dropdown-menu">
                        <div class="job_area">
                          <div class="job_input">
                            <input type="text" class="form-control" name="userinner" placeholder="Search user or Smart groups">
                            <i class="fas fa-search"></i>
                          </div>
                          <div class="usertitle">All users</div>
                          <li class="user_info">
                              <a href="#" class="dropdown-item">
                                <div class="user_img">N</div>
                                <h5>User name</h5>
                                <button type="button" class="btn">Available</button>
                                <div class="user_time"><i class="far fa-clock"></i> <span>00:30</span></div>
                              </a> 
                          </li>
                          <li class="user_info">
                            <a href="#" class="dropdown-item">
                              <div class="user_img">P</div>
                              <h5>User name</h5>
                              <button type="button" class="btn">Available</button>
                              <div class="user_time"><i class="far fa-clock"></i> <span>00:30</span></div>
                            </a> 
                        </li>
                        </div>
                      </ul>
                    </div>
                    <div class="allusershift">
                      <p><i class="fas fa-unlink"></i> users qualified for this shift</p>
                      <span class="edituser">Edit</span>
                    </div>
                    <div class="allusershift shifttwo">
                      <p>How many open spots to claim</p>
                      <input type="text" class="form-control" value="1">
                    </div>
                    <div class="allusershift checkshift">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" checked id="checkshift">
                        <label class="form-check-label" for="checkshift">
                          Enable users to claim this shift
                        </label>
                        <div class="infoask"><i class="far fa-circle-question" data-bs-toggle="tooltip" data-bs-title="learn More"></i></div>
                      </div>
                    </div>
                    <div class="allusershift checkshift">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkshift2">
                        <label class="form-check-label" for="checkshift2">
                          Require admin approval for claimed shifts
                        </label>
                        <div class="infoask"><i class="far fa-circle-question" data-bs-toggle="tooltip" data-bs-title="learn More"></i></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form_group">
                  <div class="titleinput"><p>Location</p></div>
                  <div class="forminput locationarea">
                    <input type="text" class="form-control" placeholder="Type Locaiton" value="181 Mickey Mouse Ln, Orlando, FL 90210">
                    <div class="textlock"><i class="fas fa-unlock-alt"></i></div>
                  </div>
                </div>
                <div class="form_group note">
                  <div class="titleinput"><p>Note</p></div>
                  <div class="forminput">
                    <textarea class="form-control" placeholder="Type here" rows="6" >Good morning! please make sure to- 1. Turn on all light, air-conditioning and TV's.  2. Fill the deposit sheet
                      Have a great shift</textarea>
                  </div>
                </div>
                <div class="bottom_shift">
                  <div class="shift_task">
                    <p>Shift tasks</p>
                    <div class="complete"><div class="circletaks"></div> <p><span>0</span> / 4 Tasks complete</p></div>
                  </div>
                  <button type="button" class="btn">Add tasks</button>
                </div>
              </div>
            </div>
            <div class="save_shift">
              <div class="publish_area">
                <div class="btn-inside" role="group">
                  <button type="button" class="btn bgcolor"><span data-bs-toggle="tooltip" data-bs-title="Default tooltip">Publish</span> <i class="far fa-bell" data-bs-toggle="tooltip" data-bs-title="Default tooltip"></i></button>
                  
                </div>
                <div class="btn-inside" role="group">
                  <button type="button" class="btn draftdelete" data-bs-toggle="tooltip" data-bs-title="Default tooltip"><span>Save draft</span></button>
                </div>
                <div class="btn-inside" role="group">
                  <button type="button" class="btn draftdelete"><i class="far fa-trash-alt"></i></button>
                </div>
              </div>
              <div class="save_area">
                <div class="btn-inside" role="group">
                  <button type="button" class="btn draftdelete"><i class="fas fa-arrow-circle-down"></i> save as template</button>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" 
              id="template" 
              role="tabpanel" aria-labelledby="template-tab">
            <div class="tasks_area">
              <div class="img_tasks">
                <img src="{{asset ('/assets/img/placeholder-tasks.svg') }}">
              </div>
              <div class="content_tasks">
                <h3>No tasks to display</h3>
                <p>Shift tasks are great way to let your users know what you expect them to do while in the shift</p>
                <h6>Start by adding your first task</h6>
                <button type="button" class="btn"><i class="fas fa-plus"></i> Add new task</button>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" 
              id="tasks" 
              role="tabpanel" aria-labelledby="tasks-tab">
            <div class="template_area">
              <div class="searcht">
                <input type="text" class="form-control">
                <i class="fas fa-search"></i>
              </div>
              <div class="temp_inside">
                <div class="box_temp">
                  <div class="box_conent">
                    <p>8a - 12p</p>
                    <span>Morning shift</span>
                  </div>
                  <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Edit</a></li>
                      <li><a class="dropdown-item" href="#">Delete</a></li>
                      <li><a class="dropdown-item" href="#">Duplicate</a></li>
                    </ul>
                  </div>
                </div>
                <div class="box_temp temp2">
                  <div class="box_conent">
                    <p>8a - 12p</p>
                    <span>Morning shift</span>
                  </div>
                  <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Edit</a></li>
                      <li><a class="dropdown-item" href="#">Delete</a></li>
                      <li><a class="dropdown-item" href="#">Duplicate</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
      {{-- end modal  --}}
      
      <div class="left_bar" id="menubar">
        <i class="fas fa-bars" id="menuIcon"></i>
        <i class="far fa-times-circle" id="crossicon"></i>
      </div>
      <div class="main_box">
        <div class="box_item box_width">
          <div class="top_title">
            <div class="search_inside">
              <input type="text" class="form-control" id="search" placeholder="Search users">
              <button type="submit" class="btn search_btn"><i class="fas fa-search"></i></button>
            </div>
            <div class="sort_icon"><i class="fas fa-sort"></i></div>
          </div>
          <div class="body_item infoheight">
            <div class="flex_info"><i class="far fa-file-alt"></i> <p>Daily info</p></div>
          </div>
          <div class="body_item">
            <div class="flex_info"><p>Unassigned shifts</p> <i class="fas fa-magic"></i></div>
          </div>
          <div class="body_item userheight">
            <div class="flex_info">
              <div class="user_profile"><img src="{{asset ('/assets/img/provile.webp')}} "></div>
              <div class="detail_user">
                <p>Mike Jones</p>
                <div class="detailinfo">
                  <i class="far fa-clock"></i>
                  <span>01:30</span>
                  <span class="number_profile"><i class="fas fa-boxes"></i> 3</span>
                </div>
              </div>
              <div class="dropdown dropend userbtn">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  
                  <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                </button>
                <ul class="dropdown-menu">
                  <li><span class="titlesmall">Weeks Actions</span></li>
                  <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                  <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                  <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><span class="titlesmall">Template</span></li>
                  <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                  <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="body_item">
            <div class="flex_info">
              <div class="user_profile"><img src="{{asset ('/assets/img/provile.webp')}}"></div>
              <div class="detail_user">
                <p>Mike Jones</p>
                <div class="detailinfo">
                  <i class="far fa-clock"></i>
                  <span>01:30</span>
                  <span class="number_profile"><i class="fas fa-boxes"></i> 3</span>
                </div>
              </div>
              <div class="dropdown dropend userbtn">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  
                  <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                </button>
                <ul class="dropdown-menu">
                  <li><span class="titlesmall">Weeks Actions</span></li>
                  <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                  <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                  <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><span class="titlesmall">Template</span></li>
                  <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                  <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        {{-- end item  --}}
        <div class="date_items" id="maindate">
          <div class="box_item">
            <div class="top_title day_week">
              <div class="day_details">
                <div class="name_week">
                  <p>Mon 12/16</p>
                  <div class="dropdown dropend">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      
                      <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                    </button>
                    <ul class="dropdown-menu">
                      <li><span class="titlesmall">Weeks Actions</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><span class="titlesmall">Template</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                    </ul>
                  </div>
                </div>
                <div class="detailinfo">
                  <i class="far fa-clock"></i>
                  <span>01:30</span>
                  <span class="number_profile"><i class="fas fa-boxes"></i> 3</span>
                  <span class="number_profile"><i class="fas fa-user"></i> 1</span>
                </div>
              </div>
            </div>
            <div class="body_item infoheight">
              <div class="flex_info iconbtn">
                <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="body_item">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="body_item userheight">
              <div class="flex_info boxtime" id="dragging">
                  <div class="timesitem bg_one" id="item1" draggable="true">
                    <div class="times">
                      <p>8:30a - 9:15a</p>
                      <div class="dropdown dropend">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Select</a></li>
                          <li class="dropdown drinside">
                            <a class="dropdown-item" href="#"> Asssign users <div class="check"><i class="fas fa-angle-right"></i></div></a>
                            <ul class="dropdown-menu dropend">
                              <li><a class="dropdown-item listview" href="#"> Sort by job's name</a></li>
                            </ul>
                          </li>
                          <li class="dropdown drinside">
                            <a class="dropdown-item" href="#"> Allocate users <div class="check"><i class="fas fa-angle-right"></i></div></a>
                            <ul class="dropdown-menu dropend">
                              <li><a class="dropdown-item listview" href="#"> Sort by job's name</a></li>
                            </ul>
                          </li>
                          <li class="dropdown drinside">
                            <a class="dropdown-item" href="#"> Duplicate <div class="check"><i class="fas fa-angle-right"></i></div></a>
                            <ul class="dropdown-menu dropend">
                              <li><a class="dropdown-item listview" href="#"> Sort by job's name</a></li>
                            </ul>
                          </li>
                          <li class="dropdown drinside">
                            <a class="dropdown-item" href="#"> Multi duplicate <div class="check"><i class="fas fa-angle-right"></i></div></a>
                            <ul class="dropdown-menu dropend">
                              <li><a class="dropdown-item listview" href="#"> Sort by job's name</a></li>
                            </ul>
                          </li>
                          <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Unassign</a></li>
                          <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Start chat</a></li>
                          <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Publish</a></li>
                          <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Delete</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="detailtime">
                      <span class="timename">3 Dogs / Basic Clean-Up</span>
                      <button class="btn shapeslide" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="timesitem bg_two" id="item2" draggable="true">
                    <div class="times">
                      <p>8:30a - 9:15a</p>
                      <div class="dropdown dropend">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Select</a></li>
                          <li class="dropdown drinside">
                            <a class="dropdown-item" href="#"> Asssign users <div class="check"><i class="fas fa-angle-right"></i></div></a>
                            <ul class="dropdown-menu dropend">
                              <li><a class="dropdown-item listview" href="#"> Sort by job's name</a></li>
                            </ul>
                          </li>
                          <li class="dropdown drinside">
                            <a class="dropdown-item" href="#"> Allocate users <div class="check"><i class="fas fa-angle-right"></i></div></a>
                            <ul class="dropdown-menu dropend">
                              <li><a class="dropdown-item listview" href="#"> Sort by job's name</a></li>
                            </ul>
                          </li>
                          <li class="dropdown drinside">
                            <a class="dropdown-item" href="#"> Duplicate <div class="check"><i class="fas fa-angle-right"></i></div></a>
                            <ul class="dropdown-menu dropend">
                              <li><a class="dropdown-item listview" href="#"> Sort by job's name</a></li>
                            </ul>
                          </li>
                          <li class="dropdown drinside">
                            <a class="dropdown-item" href="#"> Multi duplicate <div class="check"><i class="fas fa-angle-right"></i></div></a>
                            <ul class="dropdown-menu dropend">
                              <li><a class="dropdown-item listview" href="#"> Sort by job's name</a></li>
                            </ul>
                          </li>
                          <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Unassign</a></li>
                          <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Start chat</a></li>
                          <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Publish</a></li>
                          <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Delete</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="detailtime">
                      <span class="timename">3 Dogs / Basic Clean-Up</span>
                      <button class="btn shapeslide" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                    </div>
                  </div>
              </div>
            </div>
            <div class="body_item">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- end item  --}}
          <div class="box_item">
            <div class="top_title day_week">
              <div class="day_details">
                <div class="name_week">
                  <p>Mon 12/17</p>
                  <div class="dropdown dropend">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      
                      <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                    </button>
                    <ul class="dropdown-menu">
                      <li><span class="titlesmall">Weeks Actions</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><span class="titlesmall">Template</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                    </ul>
                  </div>
                </div>
                <div class="detailinfo">
                  <i class="far fa-clock"></i>
                  <span>01:30</span>
                  <span class="number_profile"><i class="fas fa-boxes"></i> 3</span>
                  <span class="number_profile"><i class="fas fa-user"></i> 1</span>
                </div>
              </div>
            </div>
            <div class="body_item infoheight">
              <div class="flex_info iconbtn">
                <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="body_item">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="body_item userheight">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="body_item ">
              <div class="flex_info boxtime">
                <div class="timesitem">
                  <div class="times">
                    <p>8:30a - 9:15a</p>
                    <div class="dropdown dropend">
                      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Select</a></li>
                        <li class="dropdown drinside">
                          <a class="dropdown-item" href="#"> Asssign users <div class="check"><i class="fas fa-angle-right"></i></div></a>
                          <ul class="dropdown-menu dropend">
                            <li><a class="dropdown-item listview" href="#"> Sort by job's name</a></li>
                          </ul>
                        </li>
                        <li class="dropdown drinside">
                          <a class="dropdown-item" href="#"> Allocate users <div class="check"><i class="fas fa-angle-right"></i></div></a>
                          <ul class="dropdown-menu dropend">
                            <li><a class="dropdown-item listview" href="#"> Sort by job's name</a></li>
                          </ul>
                        </li>
                        <li class="dropdown drinside">
                          <a class="dropdown-item" href="#"> Duplicate <div class="check"><i class="fas fa-angle-right"></i></div></a>
                          <ul class="dropdown-menu dropend">
                            <li><a class="dropdown-item listview" href="#"> Sort by job's name</a></li>
                          </ul>
                        </li>
                        <li class="dropdown drinside">
                          <a class="dropdown-item" href="#"> Multi duplicate <div class="check"><i class="fas fa-angle-right"></i></div></a>
                          <ul class="dropdown-menu dropend">
                            <li><a class="dropdown-item listview" href="#"> Sort by job's name</a></li>
                          </ul>
                        </li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Unassign</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Start chat</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Publish</a></li>
                        <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Delete</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="detailtime">
                    <span class="timename">3 Dogs / Basic Clean-Up</span>
                    <button class="btn shapeslide" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- end item  --}}
          <div class="box_item">
            <div class="top_title day_week">
              <div class="day_details">
                <div class="name_week">
                  <p>Mon 12/18</p>
                  <div class="dropdown dropend">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      
                      <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                    </button>
                    <ul class="dropdown-menu">
                      <li><span class="titlesmall">Weeks Actions</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><span class="titlesmall">Template</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                    </ul>
                  </div>
                </div>
                <div class="detailinfo">
                  <i class="far fa-clock"></i>
                  <span>01:30</span>
                  <span class="number_profile"><i class="fas fa-boxes"></i> 3</span>
                  <span class="number_profile"><i class="fas fa-user"></i> 1</span>
                </div>
              </div>
            </div>
            <div class="body_item infoheight">
              <div class="flex_info iconbtn">
                <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="body_item">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="body_item userheight">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="body_item">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- end item  --}}
          <div class="box_item">
            <div class="top_title day_week">
              <div class="day_details">
                <div class="name_week">
                  <p>Mon 12/19</p>
                  <div class="dropdown dropend">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      
                      <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                    </button>
                    <ul class="dropdown-menu">
                      <li><span class="titlesmall">Weeks Actions</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><span class="titlesmall">Template</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                    </ul>
                  </div>
                </div>
                <div class="detailinfo">
                  <i class="far fa-clock"></i>
                  <span>01:30</span>
                  <span class="number_profile"><i class="fas fa-boxes"></i> 3</span>
                  <span class="number_profile"><i class="fas fa-user"></i> 1</span>
                </div>
              </div>
            </div>
            <div class="body_item infoheight">
              <div class="flex_info iconbtn">
                <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="body_item">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="body_item userheight">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="body_item">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- end item  --}}
          <div class="box_item">
            <div class="top_title day_week">
              <div class="day_details">
                <div class="name_week">
                  <p>Mon 12/20</p>
                  <div class="dropdown dropend">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      
                      <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                    </button>
                    <ul class="dropdown-menu">
                      <li><span class="titlesmall">Weeks Actions</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><span class="titlesmall">Template</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                    </ul>
                  </div>
                </div>
                <div class="detailinfo">
                  <i class="far fa-clock"></i>
                  <span>01:30</span>
                  <span class="number_profile"><i class="fas fa-boxes"></i> 3</span>
                  <span class="number_profile"><i class="fas fa-user"></i> 1</span>
                </div>
              </div>
            </div>
            <div class="body_item infoheight">
              <div class="flex_info iconbtn">
                <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="body_item">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="body_item userheight">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="body_item">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- end item  --}}
          <div class="box_item">
            <div class="top_title day_week">
              <div class="day_details">
                <div class="name_week">
                  <p>Mon 12/21</p>
                  <div class="dropdown dropend">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      
                      <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                    </button>
                    <ul class="dropdown-menu">
                      <li><span class="titlesmall">Weeks Actions</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><span class="titlesmall">Template</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                    </ul>
                  </div>
                </div>
                <div class="detailinfo">
                  <i class="far fa-clock"></i>
                  <span>01:30</span>
                  <span class="number_profile"><i class="fas fa-boxes"></i> 3</span>
                  <span class="number_profile"><i class="fas fa-user"></i> 1</span>
                </div>
              </div>
            </div>
            <div class="body_item infoheight">
              <div class="flex_info iconbtn">
                <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="body_item">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="body_item userheight">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="body_item">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- end item  --}}
          <div class="box_item">
            <div class="top_title day_week">
              <div class="day_details">
                <div class="name_week">
                  <p>Mon 12/21</p>
                  <div class="dropdown dropend">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      
                      <div class="date_dot"><i class="fas fa-ellipsis-v"></i></div>
                    </button>
                    <ul class="dropdown-menu">
                      <li><span class="titlesmall">Weeks Actions</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-copy"></i></div> Copy previous week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-magic"></i></div> Auto assign week</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus"></i></div> Clear week</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><span class="titlesmall">Template</span></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-download"></i></div> Save week as template</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-upload"></i></div> Load week template</a></li>
                    </ul>
                  </div>
                </div>
                <div class="detailinfo">
                  <i class="far fa-clock"></i>
                  <span>01:30</span>
                  <span class="number_profile"><i class="fas fa-boxes"></i> 3</span>
                  <span class="number_profile"><i class="fas fa-user"></i> 1</span>
                </div>
              </div>
            </div>
            <div class="body_item infoheight">
              <div class="flex_info iconbtn">
                <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
              </div>
            </div>
            <div class="body_item">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="body_item userheight">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="body_item">
              <div class="flex_info iconbtn">
                <div class="plus_info">
                  <button class="btn mdoalbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                  <div class="dropdown dropend">
                    <button class="btn mdoalbtn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="drinside">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="flexname"><i class="fas fa-text-height"></i> </div>Add from templates <div class="check"><i class="fas fa-angle-right"></i></div>
                        </button>
                        <ul class="dropdown-menu dropend">
                        <li class="select_template">
                            <div class="toptemplate">
                              <h5>Select Template</h5>
                              <button class="btn addbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="searchtemplate">
                              <input type="text" class="form-control" placeholder="Search">
                              <button type="submit" class="btn searchbtn"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="temp_list">
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                              <div class="item_temp">
                                <p>8a - 12p</p>
                                <span>Morning shift [Sample]</span>
                              </div>
                            </div>
                        </li>
                        </ul>
                      </li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="far fa-sun"></i></div> Add time off</a></li>
                      <li><a class="dropdown-item" href="#"><div class="icon_action"><i class="fas fa-minus-circle"></i></div> Add unavailability</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="calendar"></div>
        {{-- end item  --}}
      </div>
    </div>
  </div>
</div>
@endsection

