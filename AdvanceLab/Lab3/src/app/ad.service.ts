import { Injectable }           from '@angular/core';

import { CartJobAdComponent } from './cart-job-ad.component';
import { CartProfileComponent } from './cart-profile.component';
import { AdItem }               from './ad-item';

@Injectable()
export class AdService {
  getAds() {
    return [
      new AdItem(CartProfileComponent, {name: 'Bombasto', bio: 'Brave as they come'}),

      new AdItem(CartProfileComponent, {name: 'Dr IQ', bio: 'Smart as they come'}),

      new AdItem(CartJobAdComponent,   {headline: 'Hiring for several positions',
                                        body: 'Submit your resume today!'}),

      new AdItem(CartJobAdComponent,   {headline: 'Openings in all departments',
                                        body: 'Apply today'}),
    ];
  }
}
