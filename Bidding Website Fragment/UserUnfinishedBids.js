import db from '../db'
import React, { useState, useEffect, useContext } from "react";
import UserContext from '../UserContext'
import { makeStyles } from "@material-ui/core/styles";
import GridContainer from "../components/Grid/GridContainer.js";
import GridItem from "../components/Grid/GridItem.js";
import styles from "../assets/jss/material-kit-react/views/landingPageSections/productStyle.js";

import BidsByUnfinishedAuctions from "Mikhaelle/BidsByUnfinishedAuctions"


const useStyles = makeStyles(styles);
export default function UserUnfinishedBids() {

  const { user } = useContext(UserContext)

  const classes = useStyles();

  const [unfinishedBid, setUnfinished] = useState([])
  useEffect(() => db.Auctions.listenToUnfinished(setUnfinished), [])
  // //console.log("list of unfinished bids",unfinishedBid)

  return (
    <div className={classes.section}>
      <GridContainer justify="center">
        <GridItem xs={12} sm={12} md={8}>
          <h2 className={classes.title}>User Bids</h2>
        </GridItem>
      </GridContainer>
      <GridContainer>
        {/* <span> p</span> */}
        {
          unfinishedBid.map((auction, i) =>
            // key={auction.id}
            // <span key={i}> 

            //   <BidsByUnfinishedAuctions key={i} {...auction} user={user}/>
            // </span>
            <div key={i}>
              <BidsByUnfinishedAuctions key={auction.id} {...auction} user={user} />
            </div>
          )
        }
      </GridContainer>
    </div>
  )
}
