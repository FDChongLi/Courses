import { Component, Input }  from '@angular/core';

import { AdComponent }       from './ad.component';

@Component({
  template: `
    <div class="People-profile">
      <h3>Featured People Profile</h3>
      <h4>{{data.name}}</h4>

      <p>{{data.bio}}</p>

      <strong>Hire this People today!</strong>
    </div>
  `
})
export class CartProfileComponent implements AdComponent {
  @Input() data: any;
}


